<?php

/**
 * This configuration is for aspects of the front end and UI.
 */

return [
	"options" => [
		// Turns on relative permalinks
		"relative-links" => true,
		// Forces any absolute urls in the output to this, if in production.
		"force-domain" => (env('WP_ENV') == 'production') ? "https://indotrek.com" : false,
		// Configure the view engine
		"views" => [
			// Which engine to use, either "twig" or "blade"
			"engine" => "blade",

			// directory within your theme to cache views
			"cache" => "cache/views",

			// Clears the view cache on each page load, useful in debugging
			"reset-cache" => ((env('WP_ENV') != 'production') && isset($_GET['no-cache'])),

			// register your custom blade directives
			"directives" => [
			]
		]
	],

	// Scripts and CSS to enqueue
	"enqueue" => [
		// The public path to serve assets from, relative to the theme's root path
		"public-path" => "/public/",
		// Adds the `defer` attribute to all script tags.  Increases page speed.
		"defer-all" => false,
		// Controls whether a manifest is used for enqueueing assets like scripts and css
		"use-manifest" => false,
		// The manifest to use
		"manifest" => "",
		// list the js files you want to enqueue
		"js" => [
			// "styles.js",
			// "vendor.js",
			// "main.js",
		],
		// list the css files you want to enqueue
		"css" => [
			"vendor.css",
			"styles.css",
			"main.css",
		]
	],

	// WordPress support
	"support" => [
		"automatic-feed-links" => true,
		"title-tag" => true,
		"post-thumbnails" => [
			"width" => 288,
			"height" => 323,
			"crop" => true
		],
		"html5" => [
			"search-form",
			"comment-form",
			"comment-list",
			"gallery",
			"caption"
		]
	],

	// Menu options
	"menu" => [
		"primary" => "Primary",
		"mobile" => "Mobile",
		"footer" => "Footer",
		'main' => 'Main Menu'
	],

	// Sidebar Areas
	"sidebars" => [
	],

	// Configure the WordPress content editor
	"editor" => [
		// Additional editor styles to load
		"styles" => [
		],
		// List of plugins to add
		"plugins" => [
		]
	],

	// Configure the customizer
	"customizer" => [
		// Use kirki for customization or not.  You should use it though.
		"use_kirki" => false,
		//
		//	    // Customizer Panels
		//	    "panels" => [
		//		    "stem-base-options" => [
		//			    "title" => "Theme Options",
		//			    "priority" => 100
		//		    ]
		//	    ],
		//
		//	    // Customizer sections
		//	    "sections" => [
		//		    "stem-theme-images" => [
		//			    "title" => "Images",
		//			    "panel" => "stem-base-options",
		//			    "priority" => 100
		//		    ]
		//	    ],
		//
		//	    // Theme settings
		//	    "settings" => [
		//		    "background_image" => [
		//			    "default" => null,
		//			    "control" => [
		//				    "label" => "Background Image",
		//				    "section" => "stem-theme-images",
		//				    "type" => "image"
		//			    ],
		//		        'output' => [
		//		        	[
		//		        		'element' => 'body',
		//			            'property' => 'background-image'
		//			        ]
		//		        ]
		//		    ],
		//		    "logo_image" => [
		//			    "default" => null,
		//			    "control" => [
		//				    "label" => "Logo Image",
		//				    "section" => "stem-theme-images",
		//				    "type" => "image"
		//			    ],
		//			    'output' => [
		//				    [
		//					    'element' => '.home-link',
		//					    'property' => 'background-image'
		//				    ]
		//			    ]
		//		    ]
		//	    ]
	],

	// Clean up generated HTML options
	"clean" => [
		"remove" => [
			"text" => [
				"<link rel='https://api.w.org/' href='http://mi.lk/wp-json/' />",
				"<link rel=\"alternate\" type=\"application/rss+xml\" title=\"Milk &raquo; Comments Feed\" href=\"http://mi.lk/comments/feed/\" />",
				"<link rel='https://api.w.org/' href='http://milkmade.dev/wp-json/' />",
				"<link rel=\"alternate\" type=\"application/rss+xml\" title=\"Milk &raquo; Comments Feed\" href=\"http://milkmade.dev/comments/feed/\" />",
				"<meta name=\"generator\" content=\"NGFB Pro 8.10.3L +UM\"/>"
			]
		],

		"wp_head" => [
			"rsd_link",
			"wlwmanifest_link",
			"wp_generator",
			"start_post_rel_link",
			"index_rel_link",
			"parent_post_rel_link",
			"adjacent_posts_rel_link_wp_head",
			"wp_shortlink_wp_head"
		],

		"headers" => [
			"X-Pingback"
		]
	]
];