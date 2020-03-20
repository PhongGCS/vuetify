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

namespace ILAB\MediaCloud\Tools\MediaUpload;

use ILAB\MediaCloud\Storage\StorageInterface;
use ILAB\MediaCloud\Storage\StorageManager;
use ILAB\MediaCloud\Storage\StorageSettings;
use ILAB\MediaCloud\Tools\Storage\StorageTool;
use ILAB\MediaCloud\Tools\Tool;
use ILAB\MediaCloud\Tools\ToolsManager;
use ILAB\MediaCloud\Utilities\Environment;
use ILAB\MediaCloud\Utilities\NoticeManager;
use ILAB\MediaCloud\Utilities\View;
use function ILAB\MediaCloud\Utilities\arrayPath;
use function ILAB\MediaCloud\Utilities\json_response;

if(!defined('ABSPATH')) {
	header('Location: /');
	die;
}

/**
 * Class ILabMediaUploadTool
 *
 * Video Tool.
 */
class UploadTool extends Tool {
	//region Class Variables
	/** @var StorageInterface */
	private $client;

	/** @var bool  */
	private $integrationMode = true;

	/** @var int  */
	private $maxUploads = 4;

	/** @var bool */
	private $detectFaces;

	//endregion

    public function __construct($toolName, $toolInfo, $toolManager) {
        parent::__construct($toolName, $toolInfo, $toolManager);

        $this->testForBadPlugins();
        $this->testForUselessPlugins();

	    $this->integrationMode = Environment::Option('mcloud-direct-uploads-integration', null, true);
	    $this->maxUploads = Environment::Option('mcloud-direct-uploads-simultaneous-uploads', null, 4);
	    $this->detectFaces = Environment::Option('mcloud-direct-uploads-detect-faces', null, false);

	    if (!function_exists('curl_multi_init')) {
		    NoticeManager::instance()->displayAdminNotice('error', "You are missing <a href='http://php.net/manual/en/curl.installation.php' target='_blank'>cURL support</a> which can cause issues with various Media Cloud features such as direct upload.  You should install cURL support before using this plugin.", true, 'media-cloud-curl-warning');
	    }
    }

    //region Tool Overrides
	public function setup() {
		parent::setup();



		$this->client = StorageManager::storageInstance();
		if ($this->client && $this->client->enabled() && $this->client->supportsDirectUploads()) {
		    add_action('init', function() {
			    if (current_user_can('upload_files')) {
				    $this->setupAdmin();
				    $this->setupAdminAjax();
				    $this->hookupUploadUI();
			    }
            });
		}
	}

	public function enabled() {
		if(!parent::enabled()) {
			return false;
		}

		if (!function_exists('curl_multi_init')) {
			return false;
		}

		if (!$this->client || !$this->client->enabled()) {
			return false;
		}

		return $this->client->supportsDirectUploads();
	}

	public function hasSettings() {
		return true;
	}
	//endregion

	//region Admin Setup

    /**
     * Register Menus
     * @param $top_menu_slug
     */
    public function registerMenu($top_menu_slug, $networkMode = false, $networkAdminMenu = false) {
        parent::registerMenu($top_menu_slug);

        if($this->enabled() && ((!$networkMode && !$networkAdminMenu) || ($networkMode && !$networkAdminMenu)) && (!$this->integrationMode)) {
            ToolsManager::instance()->insertToolSeparator();
            ToolsManager::instance()->addMultisiteTool($this);
            $this->options_page = 'media-cloud-upload-admin';
            add_submenu_page($top_menu_slug, 'Media Cloud Upload', 'Cloud Upload', 'upload_files', 'media-cloud-upload-admin', [
                $this,
                'renderSettings'
            ]);
        }
    }

	/**
	 * Setup upload UI
	 */
	public function setupAdmin() {

		add_action('admin_footer', function() {
			$imgixDetectFaces = apply_filters('media-cloud/imgix/detect-faces', false);
			$visionDetectFaces =  apply_filters('media-cloud/vision/detect-faces', false);

			if(current_user_can('upload_files') && $this->enabled()) {
				if (($this->detectFaces) && (!$imgixDetectFaces && !$visionDetectFaces)) {
					?>
					<script>
                        var LocalVisionMediaURL = '<?php echo ILAB_PUB_URL.'/models/'; ?>';
					</script>
					<?php
				}
			}
		});

		add_action('admin_enqueue_scripts', function() {
			$imgixDetectFaces = apply_filters('media-cloud/imgix/detect-faces', false);
			$visionDetectFaces =  apply_filters('media-cloud/vision/detect-faces', false);
			if(current_user_can('upload_files') && $this->enabled()) {
				wp_enqueue_script('wp-util');

				if (($this->detectFaces) && (!$imgixDetectFaces && !$visionDetectFaces)) {
					wp_enqueue_script('face-api-js', ILAB_PUB_JS_URL . '/face-api.js', ['jquery', 'wp-util'], false, true);
					wp_enqueue_script('ilab-face-detect-js', ILAB_PUB_JS_URL . '/ilab-face-detect.js', ['face-api-js'], false, true);
				}

				if ($this->integrationMode) {
					wp_enqueue_script('ilab-media-direct-upload-js', ILAB_PUB_JS_URL . '/ilab-media-direct-upload.js', ['jquery', 'wp-util'], false, true);
				}

				wp_enqueue_script('ilab-media-upload-js', ILAB_PUB_JS_URL . '/ilab-media-upload.js', ['jquery', 'wp-util'], false, true);

				$this->client->enqueueUploaderScripts();
			}
		});

		add_action('admin_menu', function() {
			if(current_user_can('upload_files')) {
				if($this->enabled()) {
					if ($this->integrationMode) {
						remove_submenu_page('upload.php', 'media-new.php');

						add_media_page('Cloud Upload', 'Add New', 'upload_files', 'media-cloud-upload', [
							$this,
							'renderSettings'
						]);
					} else {
						add_media_page('Cloud Upload', 'Cloud Upload', 'upload_files', 'media-cloud-upload', [
							$this,
							'renderSettings'
						]);
					}
				}
			}
		});
	}

	/**
	 * Install Ajax Endpoints
	 */
	public function setupAdminAjax() {
		add_action('wp_ajax_ilab_upload_prepare', function() {
			$this->prepareUpload();
		});

		add_action('wp_ajax_ilab_upload_import_cloud_file', function() {
			$this->importUploadedFile();
		});

		add_action('wp_ajax_ilab_upload_process_batch', function() {
			$this->processUploadBatch();
		});

		add_action('wp_ajax_ilab_upload_attachment_info', function() {
			$postId = $_POST['postId'];

			json_response(wp_prepare_attachment_for_js($postId));
		});
	}

	public function hookupUploadUI() {
		add_action('admin_footer', function() {
			if(current_user_can('upload_files')) {
				$this->doRenderDirectUploadSettings();
				include ILAB_VIEW_DIR . '/upload/ilab-media-direct-upload.php';
			}
		});

		add_action('customize_controls_enqueue_scripts', function() {
			if(current_user_can('upload_files')) {
				$this->doRenderDirectUploadSettings();
				include ILAB_VIEW_DIR . '/upload/ilab-media-direct-upload.php';
			}
		});
	}
	//endregion

	//region Ajax Endpoints
    private function processUploadBatch() {
	    if(!current_user_can('upload_files')) {
		    json_response(["status" => "error", "message" => "Current user can't upload."]);
	    }

	    if (!isset($_POST['batch'])) {
		    json_response(["status" => "error", "message" => "Invalid batch."]);
        }

	    if (!is_array($_POST['batch'])) {
		    json_response(["status" => "error", "message" => "Invalid batch."]);
        }

	    do_action('media-cloud/direct-uploads/process-batch', $_POST['batch']);

	    json_response(["status" => "ok"]);
    }


	/**
	 * Called after a file has been uploaded and needs to be imported into the system.
	 */
	private function importUploadedFile() {
		if(!current_user_can('upload_files')) {
			json_response(["status" => "error", "message" => "Current user can't upload."]);
		}

		if(empty($_POST['key'])) {
			json_response(['status' => 'error', 'message' => 'Missing key.']);
		}

		$key = $_POST['key'];
		$faces = arrayPath($_POST, 'faces', null);

		$info = $this->client->info($key);

		$unknownMimes = [
			'application/octet-stream',
			'application/binary',
			'unknown/unknown'
		];

		/** @var StorageTool $storageTool */
		$storageTool = ToolsManager::instance()->tools['storage'];
		if (!$storageTool->enabled()) {
			json_response(['status' => 'error', 'message' => 'Storage not enabled.']);
        }

		if(!empty($info->mimeType()) && !in_array($info->mimeType(), $unknownMimes)) {
			$result = $storageTool->importAttachmentFromStorage($info);
			if($result) {
				if (!empty($faces)) {
					$meta = wp_get_attachment_metadata($result['id']);
					$meta['faces'] = $faces;

					add_filter('media-cloud/storage/ignore-metadata-update', [$this, 'ignoreMetadataUpdate'], 10, 2);
					wp_update_attachment_metadata($result['id'], $meta);
					remove_filter('media-cloud/storage/ignore-metadata-update', [$this, 'ignoreMetadataUpdate'], 10);
				}

				json_response(['status' => 'success', 'data' => $result, 'attachment' => wp_prepare_attachment_for_js($result['id'])]);
			} else {
				json_response(['status' => 'error', 'message' => 'Error importing S3 file into WordPress.']);
			}
		} else {
			json_response(['status' => 'error', 'message' => 'Unknown type.', 'type' => $info->mimeType()]);
		}
	}

	public function ignoreMetadataUpdate($shouldIgnore, $id) {
		return true;
	}

	/**
	 * Called when ready to upload to the storage service
	 */
	private function prepareUpload() {
		if(!current_user_can('upload_files')) {
			json_response(["status" => "error", "message" => "Current user can't upload."]);
		}

		if (!$this->client || !$this->client->enabled()) {
			json_response(["status" => "error", "message" => "Storage settings are invalid."]);
		}

		$filename = $_POST['filename'];
		$type = $_POST['type'];
		$prefix = (!isset($_POST['directory'])) ? null : $_POST['directory'];

		if (empty($filename) || empty($type)) {
			json_response(["status" => "error", "message" => "Invalid file name or missing type."]);
		}

		if ($prefix === null) {
			$sitePrefix = '';

			if (is_multisite() && !is_main_site()) {
				$root = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'uploads';
				$uploadDir = wp_get_upload_dir();
				$sitePrefix = ltrim(str_replace($root, '', $uploadDir['basedir']), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
			}

			$prefix = $sitePrefix.StorageSettings::prefix(null);
		} else if (!empty($prefix)) {
			$prefix = trailingslashit($prefix);
		}

		$parts = explode('/', $filename);
		$bucketFilename = array_pop($parts);

		$uploadInfo = $this->client->uploadUrl($prefix.$bucketFilename,StorageSettings::privacy(), $type,StorageSettings::cacheControl(), StorageSettings::expires());
		$res = $uploadInfo->toArray();
		$res['status'] = 'ready';
		json_response($res);
	}

	/**
	 * Render settings.
	 *
	 * @param bool $insertMode
	 */
	protected function doRenderSettings($insertMode) {
		$mtypes = array_values(get_allowed_mime_types(get_current_user_id()));
		$mtypes[] = 'image/psd';

		$imgixEnabled = apply_filters('media-cloud/dynamic-images/enabled', false);

		$videoEnabled = apply_filters('media-cloud/transcoder/enabled', false);
		$altFormatsEnabled = apply_filters('media-cloud/imgix/alternative-formats/enabled', false);
		$docUploadsEnabled = StorageSettings::uploadDocuments();

		$maxUploads = apply_filters('media-cloud/direct-uploads/max-uploads', $this->maxUploads);

		$result = View::render_view('upload/ilab-media-upload.php', [
			'title' => $this->toolInfo['name'],
			'driver' => StorageManager::driver(),
			'maxUploads' => $maxUploads,
			'group' => $this->options_group,
			'page' => $this->options_page,
			'imgixEnabled' => $imgixEnabled,
			'videoEnabled' => $videoEnabled,
			'altFormats' => ($imgixEnabled && $altFormatsEnabled),
			'docUploads' => $docUploadsEnabled,
			'insertMode' => $insertMode,
			'allowedMimes' => $mtypes
		]);

		echo $result;
	}

	/**
	 * Render settings.
	 */
	protected function doRenderDirectUploadSettings() {
		$mtypes = array_values(get_allowed_mime_types(get_current_user_id()));
		$mtypes[] = 'image/psd';

		$imgixEnabled = apply_filters('media-cloud/dynamic-images/enabled', false);

		$videoEnabled = apply_filters('media-cloud/transcoder/enabled', false);
		$altFormatsEnabled = apply_filters('media-cloud/imgix/alternative-formats/enabled', false);
		$docUploadsEnabled = StorageSettings::uploadDocuments();

		$maxUploads = apply_filters('media-cloud/direct-uploads/max-uploads', $this->maxUploads);

		$result = View::render_view('upload/direct-upload-settings', [
			'driver' => StorageManager::driver(),
			'maxUploads' => ($maxUploads > 0) ? $maxUploads : 4,
			'imgixEnabled' => $imgixEnabled,
			'videoEnabled' => $videoEnabled,
			'altFormats' => ($imgixEnabled && $altFormatsEnabled),
			'docUploads' => $docUploadsEnabled,
			'allowedMimes' => $mtypes
		]);

		echo $result;
	}

	/**
	 * Render settings.
	 */
	public function renderSettings() {
		$this->doRenderSettings(false);
	}

	/**
	 * Render settings.
	 */
	public function renderInsertSettings() {
		$this->doRenderSettings(true);
	}
	//endregion
}