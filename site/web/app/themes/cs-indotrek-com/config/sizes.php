<?php

/**
 * This configuration controls image sizes and other things related to that.
 */

return [
	// Controls which of WordPress's default sizes are enabled or disabled.
	"disable-wp-sizes" => [
		//    "medium",
		//    "small",
		//    "large"
	],

	// Defines the image sizes you'll use in this app.
	"sizes" => [
		"tour-thumbnail" => [ // ratio 3:2
			"width" => 600,
			"height" => 400,
			"crop" => true
		],
		"hero" => [
			"width" => 1440,
			"height" => 768,
			"crop" => true
		],
		"hero-mobile" => [
				"width" => 768,
				"height" => 1100,
				"crop" => true
		],
		"full-width" => [
			"width" => 1920,
			"height" => 900,
			"crop" => false
		],
		"wide" => [
			"width" => 800,
			"height" => 500,
			"crop" => true
		],
		"square" => [
				"width" => 800,
				"height" => 800,
				"crop" => true
		],
		"tall" => [
				"width" => 768,
				"height" => 1100,
				"crop" => true
		],
	],

	// Allows you to define alternate sizes for the srcset attribute for images using a particular
	// size in your theme
	"srcset" => [
		"full" => [
			"srcset" => [
				"1024" => [
					"width" => 1024,
					"height" => 15000,
					"crop" => false
				],
				"768" => [
					"width" => 768,
					"height" => 15000,
					"crop" => false
				],
				"320" => [
					"width" => 320,
					"height" => 15000,
					"crop" => false
				]
			]
		]
	]
];