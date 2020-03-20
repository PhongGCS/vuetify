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

namespace ILAB\MediaCloud\Tools\Browser;

use GuzzleHttp\Client;
use ILAB\MediaCloud\Storage\StorageFile;
use ILAB\MediaCloud\Tools\Storage\StorageTool;
use ILAB\MediaCloud\Tools\Tool;
use ILAB\MediaCloud\Tools\ToolsManager;
use ILAB\MediaCloud\Utilities\Environment;
use ILAB\MediaCloud\Utilities\Logging\Logger;
use ILAB\MediaCloud\Utilities\View;
use function ILAB\MediaCloud\Utilities\json_response;

if (!defined( 'ABSPATH')) { header( 'Location: /'); die; }

/**
 * Class ImageSizeTool
 *
 * Tool for managing image sizes
 */
class BrowserTool extends Tool {
	private $multisiteEnabled = true;
	private $multisiteRoot = '';
	private $multisiteAllowUploads = true;
	private $multisiteAllowDeleting = true;

	public function __construct( $toolName, $toolInfo, $toolManager ) {
		parent::__construct( $toolName, $toolInfo, $toolManager );

		$this->multisiteEnabled = empty(Environment::Option('mcloud-network-browser-hide',null, false));
		$this->multisiteAllowUploads = Environment::Option('mcloud-network-browser-allow-uploads',null, true);
		$this->multisiteAllowDeleting = Environment::Option('mcloud-network-browser-allow-deleting',null, true);

		$lockToRoot = Environment::Option('mcloud-network-browser-lock-to-root',null, false);
		if (is_multisite() && $lockToRoot) {
			$dir = wp_upload_dir(null, true);
			$uploadRoot = WP_CONTENT_DIR.DIRECTORY_SEPARATOR.'uploads';

			$this->multisiteRoot = trailingslashit(ltrim(str_replace($uploadRoot, '', $dir['basedir']),DIRECTORY_SEPARATOR));
		}

		add_action('admin_enqueue_scripts', function(){

			wp_enqueue_media();

			wp_enqueue_style( 'wp-pointer' );
			wp_enqueue_script( 'wp-pointer' );
			wp_enqueue_script ( 'ilab-modal-js', ILAB_PUB_JS_URL. '/ilab-modal.js', ['jquery'], false, true );
			wp_enqueue_script ( 'ilab-media-tools-js', ILAB_PUB_JS_URL. '/ilab-media-tools.js', ['jquery'], false, true );
			wp_enqueue_script ( 'ilab-storage-browser-js', ILAB_PUB_JS_URL. '/ilab-storage-browser.js', ['jquery'], false, true );

		});

		add_action('wp_ajax_ilab_browser_select_directory', [$this, 'selectDirectory']);
		add_action('wp_ajax_ilab_browser_create_directory', [$this, 'createDirectory']);
		add_action('wp_ajax_ilab_browser_delete', [$this, 'deleteItems']);
		add_action('wp_ajax_ilab_browser_file_list', [$this, 'listFiles']);
		add_action('wp_ajax_ilab_browser_import_file', [$this, 'importFile']);

		add_action('admin_menu', function() {
			if ($this->enabled()) {
				add_media_page('Media Cloud Storage Browser', 'Storage Browser', 'manage_options', 'media-tools-storage-browser', [
					$this,
					'renderBrowser'
				]);
			}
		});

	}

	public function registerMenu($top_menu_slug, $networkMode = false, $networkAdminMenu = false) {
		parent::registerMenu($top_menu_slug);

		if ($this->enabled()) {
			ToolsManager::instance()->insertToolSeparator();
			ToolsManager::instance()->addMultisiteTool($this);
			$this->options_page = 'media-tools-storage-browser';
			add_submenu_page($top_menu_slug, 'Media Cloud Storage Browser', 'Storage Browser', 'manage_options', 'media-tools-storage-browser', [
				$this,
				'renderBrowser'
			]);


		}
	}

	public function enabled() {
		$enabled = ToolsManager::instance()->toolEnabled('storage');

		if ($enabled && is_multisite() && !is_main_site()) {
			$hide = Environment::Option('mcloud-network-browser-hide', null, false);
			$enabled = !$hide;
		}

		return $enabled;
	}

	public function renderBrowser() {
		$currentPath = (empty($_REQUEST['path'])) ? '' : $_REQUEST['path'];

		if (is_multisite() && !empty($this->multisiteRoot)) {
			if (strpos($currentPath, $this->multisiteRoot) === false) {
				$currentPath = $this->multisiteRoot;
			}
		}

		/** @var StorageTool $storageTool */
		$storageTool = ToolsManager::instance()->tools['storage'];
		$files = $storageTool->client()->dir($currentPath);

		$directUploads = ToolsManager::instance()->toolEnabled('media-upload');

		if (!empty($currentPath)) {
			$pathParts = explode('/', $currentPath);
			array_pop($pathParts);
			array_pop($pathParts);
			$parentPath = implode('/', $pathParts);
			if (!empty($parentPath)) {
				$parentPath .= '/';
			}

			$parentDirectory = new StorageFile('DIR', $parentPath, '..');
			array_unshift($files, $parentDirectory);
		}

		$mtypes = array_values(get_allowed_mime_types(get_current_user_id()));
		$mtypes[] = 'image/psd';


		echo View::render_view('storage/browser', [
			'title' => 'Cloud Storage Browser',
			'bucketName' => $storageTool->client()->bucket(),
			"path" => $currentPath,
			"directUploads" => $directUploads,
			'files' => $files,
			'allowUploads' => $this->multisiteAllowUploads,
			'allowDeleting' => $this->multisiteAllowDeleting,
			'allowedMimes' => $mtypes
		]);

	}

	public function selectDirectory() {
		if (!check_ajax_referer('storage-browser', 'nonce')) {
			json_response([
				'status' => 'error',
				'message' => 'Invalid nonce'
			]);
		}

		$currentPath = (empty($_POST['key'])) ? '' : $_POST['key'];
		$this->renderDirectory($currentPath);
	}

	protected function renderDirectory($currentPath) {
		if (is_multisite() && !empty($this->multisiteRoot)) {
			if (strpos($currentPath, $this->multisiteRoot) === false) {
				$currentPath = $this->multisiteRoot;
			}
		}

		/** @var StorageTool $storageTool */
		$storageTool = ToolsManager::instance()->tools['storage'];
		$files = $storageTool->client()->dir($currentPath);

		if (!empty($currentPath)) {
			$pathParts = explode('/', $currentPath);
			array_pop($pathParts);
			array_pop($pathParts);
			$parentPath = implode('/', $pathParts);
			if (!empty($parentPath)) {
				$parentPath .= '/';
			}

			$parentDirectory = new StorageFile('DIR', $parentPath, '..');
			array_unshift($files, $parentDirectory);
		}

		$table = View::render_view('storage/browser-table', [
			'files' => $files,
			'allowUploads' => $this->multisiteAllowUploads,
			'allowDeleting' => $this->multisiteAllowDeleting
		]);

		$header = View::render_view('storage/browser-header', [
			'bucketName' => $storageTool->client()->bucket(),
			'path' => $currentPath
		]);

		json_response([
			'status' => 'ok',
			'header' => $header,
			'table' => $table,
			'nextNonce' => wp_create_nonce('storage-browser')
		]);
	}

	public function createDirectory() {
		if (!check_ajax_referer('storage-browser', 'nonce')) {
			json_response([
				'status' => 'error',
				'message' => 'Invalid nonce'
			]);
		}

		$currentPath = (empty($_POST['key'])) ? '' : $_POST['key'];
		if (!empty($currentPath)) {
			$currentPath = rtrim($currentPath, '/').'/';
		}

		$newDirectory = (empty($_POST['directory'])) ? '' : $_POST['directory'];

		/** @var StorageTool $storageTool */
		$storageTool = ToolsManager::instance()->tools['storage'];
		if (!$storageTool->client()->createDirectory($currentPath.$newDirectory)) {
			json_response([
				'status' => 'error',
				'nextNonce' => wp_create_nonce('storage-browser')
			]);
		} else {
			$this->renderDirectory($currentPath);
		}
	}

	public function deleteItems() {
		if (!check_ajax_referer('storage-browser', 'nonce')) {
			json_response([
				'status' => 'error',
				'message' => 'Invalid nonce'
			]);
		}

		$currentPath = (empty($_POST['key'])) ? '' : $_POST['key'];

		if (empty($_POST['keys']) || !is_array($_POST['keys'])) {
			json_response([
				'status' => 'error',
				'message' => 'Missing keys'
			]);
		}

		/** @var StorageTool $storageTool */
		$storageTool = ToolsManager::instance()->tools['storage'];
		foreach($_REQUEST['keys'] as $key) {
			if (is_multisite() && !empty($this->multisiteRoot)) {
				if (strpos($key, $this->multisiteRoot) === false) {
					continue;
				}
			}

			if (strpos(strrev($key), '/') === 0) {
				$storageTool->client()->deleteDirectory($key);
			} else {
				$storageTool->client()->delete($key);
			}
		}

		$this->renderDirectory($currentPath);
	}

	public function listFiles() {
		if (!check_ajax_referer('storage-browser', 'nonce')) {
			json_response([
				'status' => 'error',
				'message' => 'Invalid nonce'
			]);
		}

		if (empty($_POST['keys']) || !is_array($_POST['keys'])) {
			json_response([
				'status' => 'error',
				'message' => 'Missing keys'
			]);
		}

		$tempFileList = [];

		/** @var StorageTool $storageTool */
		$storageTool = ToolsManager::instance()->tools['storage'];
		foreach($_REQUEST['keys'] as $key) {
			if (strpos(strrev($key), '/') === 0) {
				if (is_multisite() && !empty($this->multisiteRoot)) {
					if (strpos($key, $this->multisiteRoot) === false) {
						continue;
					}
				}

				$files = $storageTool->client()->dir($key, null);

				/** @var StorageFile $file */
				foreach($files as $file) {
					$tempFileList[] = $file->key();
				}
			} else {
				$tempFileList[] = $key;
			}
		}

		$fileList = [];
		foreach($tempFileList as $file) {
			if (strpos(strrev($file), '/') !== 0) {
				if (!preg_match('/([0-9]+x[0-9]+)\.(?:.*)$/', $file)) {
					$fileList[] = $file;
				}
			}
		}

		json_response([
			'status' => 'ok',
			'files' => $fileList,
			'nextNonce' => wp_create_nonce('storage-browser')
		]);
	}

	public function importFile() {
		if (!check_ajax_referer('storage-browser', 'nonce')) {
			json_response([
				'status' => 'error',
				'message' => 'Invalid nonce'
			]);
		}

		$key = (empty($_POST['key'])) ? '' : $_POST['key'];
		if (is_multisite() && !empty($this->multisiteRoot)) {
			if (strpos($key, $this->multisiteRoot) === false) {
				json_response([
					'status' => 'error',
					'message' => 'Invalid path'
				]);
			}
		}

		if (empty($key)) {
			json_response([
				'status' => 'error',
				'message' => 'Missing key'
			]);
		}

		$dynamicEnabled = apply_filters('media-cloud/dynamic-images/enabled', false);

		try {
			if ($dynamicEnabled) {
				$success = $this->doImportDynamicFile($key);
			} else {
				$success = $this->doImportFile($key);
			}
		} catch (\Exception $ex) {
			Logger::error($ex->getMessage());
			$success = false;
		}

		json_response([
			'status' => ($success) ? 'ok' : 'error',
			'nextNonce' => wp_create_nonce('storage-browser')
		]);
	}

	private function doImportFile($key) {
		global $wpdb;

		$dir = wp_upload_dir();
		$base = trailingslashit($dir['basedir']);

		$destFile = $base . $key;
		$desturl = trailingslashit($dir['baseurl']) . $key;


		$query = $wpdb->prepare("select ID from {$wpdb->posts} where guid = %s", $desturl);
		$postId = $wpdb->get_var($query);

		$destDir = pathinfo($destFile, PATHINFO_DIRNAME);
		if (!file_exists($destDir)) {
			@mkdir($destDir, 0777, true);
		}

		if (!file_exists($destFile)) {
			/** @var StorageTool $storageTool */
			$storageTool = ToolsManager::instance()->tools['storage'];
			$url = $storageTool->client()->presignedUrl($key);

			$client = new Client();
			$response = $client->get($url, ['save_to' => $destFile]);

			if ($response->getStatusCode() != 200) {
				return false;
			}
		}

		if (empty($postId)) {
			$filetype = wp_check_filetype(basename($destFile), null);
			$attachment = [
				'guid'           => $desturl,
				'post_mime_type' => $filetype['type'],
				'post_title'     => preg_replace('/\.[^.]+$/', '', basename($destFile)),
				'post_content'   => '',
				'post_status'    => 'inherit'
			];
			$postId = wp_insert_attachment($attachment, $destFile);
		}

		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		add_filter('media-cloud/storage/upload-master', [$this, 'uploadMaster']);

		$attach_data = wp_generate_attachment_metadata($postId, $destFile);
		wp_update_attachment_metadata($postId, $attach_data);

		remove_filter('media-cloud/storage/upload-master', [$this, 'uploadMaster']);

		return true;
	}

	private function doImportDynamicFile($key) {
		global $wpdb;

		$dir = wp_upload_dir();

		$desturl = trailingslashit($dir['baseurl']) . $key;

		/** @var StorageTool $storageTool */
		$storageTool = ToolsManager::instance()->tools['storage'];

		$info = $storageTool->client()->info($key);

		$query = $wpdb->prepare("select ID from {$wpdb->posts} where (guid = %s) or (guid = %s)", $desturl, $info->url());
		$postId = $wpdb->get_var($query);

		if (!empty($postId)) {
			return true;
		}

		$storageTool->importAttachmentFromStorage($info);

		return true;
	}

	public function uploadMaster($shouldUpload) {
		return false;
	}
}