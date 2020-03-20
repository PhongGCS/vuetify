<?php

// Copyright (c) 2016 Interfacelab LLC. All rights reserved.
//
// Released under the GPLv3 license
// http://www.gnu.org/licenses/gpl-3.0.html
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************

namespace ILAB\MediaCloud\Tools\ImageSizes;

use ILAB\MediaCloud\Tools\Tool;
use ILAB\MediaCloud\Tools\ToolsManager;
use ILAB\MediaCloud\Utilities\NoticeManager;
use ILAB\MediaCloud\Utilities\View;
use function ILAB\MediaCloud\Utilities\gen_uuid;
use function ILAB\MediaCloud\Utilities\json_response;

if (!defined( 'ABSPATH')) { header( 'Location: /'); die; }

/**
 * Class ImageSizeTool
 *
 * Tool for managing image sizes
 */
class ImageSizeTool extends Tool {
	private $customSizes = [];

	public function __construct( $toolName, $toolInfo, $toolManager ) {
		parent::__construct( $toolName, $toolInfo, $toolManager );

		$this->customSizes = get_option('ilab-custom-image-sizes', []);

		foreach($this->customSizes as $key => $size) {
			add_image_size($key, $size['width'], $size['height'], $size['crop']);
		}

		add_action('wp_ajax_ilab_new_image_size_page', [$this, 'displayAddImageSizePage']);
		add_action('wp_ajax_ilab_update_image_size', [$this, 'updateImageSize']);
		add_action('wp_ajax_ilab_delete_image_size', [$this, 'deleteImageSize']);
		add_action('admin_enqueue_scripts', function(){
			wp_enqueue_media();

			wp_enqueue_style( 'wp-pointer' );
			wp_enqueue_script( 'wp-pointer' );
			wp_enqueue_script ( 'ilab-modal-js', ILAB_PUB_JS_URL. '/ilab-modal.js', ['jquery'], false, true );
			wp_enqueue_script ( 'ilab-media-tools-js', ILAB_PUB_JS_URL. '/ilab-media-tools.js', ['jquery'], false, true );
			wp_enqueue_script ( 'ilab-image-sizes-js', ILAB_PUB_JS_URL. '/ilab-image-sizes.js', ['jquery'], false, true );
		});

		add_action('admin_init', function() {
			if (!empty($_POST['nonce']) && !wp_doing_ajax()) {
				$this->processNewImageSize();
			}
		});
	}

	public function registerMenu($top_menu_slug, $networkMode = false, $networkAdminMenu = false) {
		parent::registerMenu($top_menu_slug);

		if (!$networkAdminMenu) {
			ToolsManager::instance()->insertToolSeparator();
			ToolsManager::instance()->addMultisiteTool($this);
			$this->options_page = 'media-tools-image-sizes';
			add_submenu_page($top_menu_slug, 'Media Cloud Image Size Manager', 'Image Sizes', 'manage_options', 'media-tools-image-sizes', [
				$this,
				'renderImageSizes'
			]);
		}
	}

	public function enabled() {
		return true;
	}

	public function renderImageSizes() {
		global $_wp_additional_image_sizes;

		$themeSizes = [];
		$wpSizes = [];
		$sizes = [];

		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach($get_intermediate_image_sizes as $_size) {
			if(in_array($_size, ['thumbnail', 'medium', 'medium_large', 'large'])) {
				$crop = get_option($_size.'_crop');
				$wpSizes[] = [
					'type' => 'WordPress',
					'size' => $_size,
					'title' => ucwords(preg_replace('/[-_]/',' ', $_size)),
					'width' => get_option($_size.'_size_w'),
					'height' => get_option($_size.'_size_h'),
					'crop' => !empty($crop),
					'x-axis' => (!empty($crop) && is_array($crop) && (count($crop) == 2)) ? $crop[0] : null,
					'y-axis' => (!empty($crop) && is_array($crop) && (count($crop) == 2)) ? $crop[1] : null,
				];
			} else if (isset($this->customSizes[$_size])) {
				$crop = $this->customSizes[$_size]['crop'];
				$sizes[] = [
					'type' => 'Custom',
					'size' => $_size,
					'title' => ucwords(preg_replace('/[-_]/',' ', $_size)),
					'width' => $this->customSizes[$_size]['width'],
					'height' => $this->customSizes[$_size]['height'],
					'crop' => !empty($crop),
					'x-axis' => (!empty($crop) && is_array($crop) && (count($crop) == 2)) ? $crop[0] : null,
					'y-axis' => (!empty($crop) && is_array($crop) && (count($crop) == 2)) ? $crop[1] : null,
				];
			} else if(isset($_wp_additional_image_sizes[$_size])) {
				$crop = $_wp_additional_image_sizes[$_size]['crop'];
				$themeSizes[] = [
					'type' => 'Theme',
					'size' => $_size,
					'title' => ucwords(preg_replace('/[-_]/',' ', $_size)),
					'width' => $_wp_additional_image_sizes[$_size]['width'],
					'height' => $_wp_additional_image_sizes[$_size]['height'],
					'crop' => !empty($crop),
					'x-axis' => (!empty($crop) && is_array($crop) && (count($crop) == 2)) ? $crop[0] : null,
					'y-axis' => (!empty($crop) && is_array($crop) && (count($crop) == 2)) ? $crop[1] : null,
				];
			}
		}

		$hasDynamic = (ToolsManager::instance()->toolEnabled('imgix') || ToolsManager::instance()->toolEnabled('glide'));

		echo View::render_view('image-sizes/image-sizes', [
			'title' => 'Image Size Manager',
			'hasDynamic' => $hasDynamic,
			'sizes' => $sizes,
			'wpSizes' => array_merge($wpSizes, $themeSizes)
		]);
	}

	public function displayAddImageSizePage() {
		echo View::render_view( 'image-sizes/new-image-size', ['modal_id'=>gen_uuid(8)]);
	}

	protected function processNewImageSize() {
		$nonce = (!empty($_POST['nonce'])) ? $_POST['nonce'] : null;

		if (empty($nonce)) {
			return;
		}

		if (!wp_verify_nonce($nonce, 'add-image-size')) {
			return;
		}

		$name = (!empty($_POST['name'])) ? $_POST['name'] : null;
		if (!empty($name)) {
			$name = sanitize_title($name);
		}

		$width = (!empty($_POST['width'])) ? intval($_POST['width']) : 0;
		$height = (!empty($_POST['height'])) ? intval($_POST['height']) : 0;

		$crop = (!empty($_POST['_crop'])) ? true : false;
		$cropX = (!empty($_POST['x-axis'])) ? $_POST['x-axis'] : null;
		$cropY = (!empty($_POST['y-axis'])) ? $_POST['y-axis'] : null;

		if (empty($name) || (($width == 0) && ($height == 0))) {
			NoticeManager::instance()->displayAdminNotice('error', 'Invalid attributes for new image size.');
			return;
		}

		if (!empty($crop) && (!empty($cropX)) && !empty($cropY)) {
			$crop = [$cropX, $cropY];
		}

		$this->customSizes[$name] = [
			'width' => $width,
			'height' => $height,
			'crop' => $crop
		];

		update_option('ilab-custom-image-sizes', $this->customSizes);

		wp_redirect(admin_url('admin.php?page=media-tools-image-sizes'));
	}

	public function updateImageSize() {
		$nonce = (!empty($_POST['nonce'])) ? $_POST['nonce'] : null;

		if (empty($nonce)) {
			json_response(['status' => 'error', 'error' => 'Missing nonce.']);
		}

		if (!wp_verify_nonce($nonce, 'custom-size')) {
			json_response(['status' => 'error', 'error' => 'Invalid nonce.']);
		}

		if (empty($_POST['size'])) {
			json_response(['status' => 'error', 'error' => 'Missing size.']);
		}

		$size = $_POST['size'];

		if (!isset($this->customSizes[$size])) {
			json_response(['status' => 'error', 'error' => 'Invalid size.']);
		}

		$width = (!empty($_POST['width'])) ? intval($_POST['width']) : 0;
		$height = (!empty($_POST['height'])) ? intval($_POST['height']) : 0;

		$crop = ($_POST['crop'] == "true");
		$cropX = (!empty($_POST['xAxis'])) ? $_POST['xAxis'] : null;
		$cropY = (!empty($_POST['yAxis'])) ? $_POST['yAxis'] : null;

		if (!empty($crop) && (!empty($cropX)) && !empty($cropY)) {
			$crop = [$cropX, $cropY];
		}


		$this->customSizes[$size] = [
			'width' => $width,
			'height' => $height,
			'crop' => $crop
		];

		update_option('ilab-custom-image-sizes', $this->customSizes);

		json_response(['status' => 'ok', 'size' => $this->customSizes[$size]]);
	}

	public function deleteImageSize() {
		$nonce = (!empty($_POST['nonce'])) ? $_POST['nonce'] : null;

		if (empty($nonce)) {
			json_response(['status' => 'error', 'error' => 'Missing nonce.']);
		}

		if (!wp_verify_nonce($nonce, 'custom-size')) {
			json_response(['status' => 'error', 'error' => 'Invalid nonce.']);
		}

		if (empty($_POST['size'])) {
			json_response(['status' => 'error', 'error' => 'Missing size.']);
		}

		$size = $_POST['size'];

		if (!isset($this->customSizes[$size])) {
			json_response(['status' => 'error', 'error' => 'Invalid size.']);
		}

		unset($this->customSizes[$size]);

		update_option('ilab-custom-image-sizes', $this->customSizes);

		json_response(['status' => 'ok']);
	}
}