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

if (!defined('ABSPATH')) { header('Location: /'); die; }

return [
    "id" => "media-upload",
    "name" => "Direct Uploads",
	"description" => "Provides an easy to use tool for uploading media directly to Amazon S3, Minio or Google Cloud Storage.",
	"class" => "ILAB\\MediaCloud\\Tools\\MediaUpload\\UploadTool",
	"dependencies" => ["storage", ["imgix", "glide"]],
	"env" => "ILAB_MEDIA_UPLOAD_ENABLED",

	"settings" => [
		"options-page" => "media-tools-direct-upload",
		"options-group" => "ilab-media-direct-upload",
		"groups" => [
			"ilab-media-direct-upload-settings" => [
				"title" => "Upload Settings",
				"options" => [
					"mcloud-direct-uploads-integration" => [
						"title" => "Integrate with Media Library",
						"description" => "When uploading items through WordPress's media library, direct uploading is used.  When this option is turned off you will need to use the <strong>Cloud Upload</strong> page to perform direct uploads.",
						"display-order" => 10,
						"type" => "checkbox",
						"default" => true
					],
					"mcloud-direct-uploads-simultaneous-uploads" => [
						"title" => "Number of Simultaneous Uploads",
						"description" => "The maximum number of uploads to perform simultaneously.",
						"type" => "number",
						"default" => 4,
						"increment" => 1,
						"min" => 1,
						"max" => 8
					],
					"mcloud-direct-uploads-detect-faces" => [
						"title" => "Detect Faces",
						"description" => "Detects faces in the image.  Detected faces will be stored as additional metadata for the image.  If you are using Imgix or Dynamic Images, you can use this for cropping images centered on a face.  If you are relying on this functionality, the better option would be to use the <a href='admin.php?page=media-cloud-settings&tab=vision'>Vision</a> tool.  It is more accurate with less false positives.  If Vision is enabled, this setting is ignored in favor of Vision's results.",
						"display-order" => 8,
						"type" => "checkbox",
						"default" => false
					],
				]
			]
		]
	]
];