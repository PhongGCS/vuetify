<?php
// Generate the model map based on the existing types
$themeRoot = get_template_directory();
$customPostTypeFiles = scandir($themeRoot."/config/types");
$models = array();

foreach ($customPostTypeFiles as $type) {
    if (strlen($type) > 5) {
        // the name of the file needs to contain .php (4 characters)
        $type = str_replace(".php", "", $type);
        $modelName = \Stringy\create($type)->upperCamelize();
        $modelPath = $themeRoot."/classes/ConceptualStudio/Models/CPT/".$modelName.".php";
        $modelClass = "\\ConceptualStudio\\Models\\CPT\\".$modelName;

        if (!is_file($modelPath)) {
            // in case it does not exist, try to assign the core class path
            $modelClass = '\\ConceptualStudio\\Models\\Core\\'.$modelName;
            $modelPath = $themeRoot."/classes/ConceptualStudio/Models/Core/".$modelName.".php";
        }

        if (is_file($modelPath)) {
            $models[$type] = $modelClass;
        } else {
            vomit("$modelPath does not exist for $type");
        }
    }
}

// manually assign a model for any blog post
$models['post'] = "\\ConceptualStudio\\Models\\CPT\\BlogPost";



return [
	// Namespace for the theme
	"namespace" => "\\ConceptualStudio",

	// Text domain
	"text-domain" => "indotrek.com",

	"build" => getenv('STEM_BUILD') ?: filemtime(__FILE__),

	"options" => [
		// List of WordPress plugins this theme requires or recommends
		// For options, view the docs at http://tgmpluginactivation.com/configuration/
		"plugins" => [
		],

		// Disables XML-RPC
		"disable-xml-rpc" => true,
		// Disables WordPress's JSON API
		"disable-wp-json-api" => false,
		// Disables WordPress's dumb emoji nonsense
		"disable-emoji" => true,
		// Disable RSS
		"disable-rss" => true,

		// Controls caching HTTP headers
		"cache-control" => [
			// Enables/disable sending cache control headers
			"enabled" => true,
			// Turns on cache control headers metabox on posts and pages
			"metabox" => true,
			// Default cache-control values
			"default" => [
				// Can be: public | private | no-store | no-cache | no-store, no-cache
				"cache-control" => "public",
				// Max age to cache on proxy or browser in seconds
				"max-age" => 3200,
				// Max age to cache on proxy
				"s-maxage" => 86400
			]
		]
	],

	// Configuration for logging
	"logging" => [
		// For development environment
		"development" => [
			// For debug AND GREATER error levels
			"debug" => [
				// error_log()
				"phperror" => [
					"format" => [
						"output" => "%level_name% > %message% %context%",
						"date" => ""
					]
				],

				// Will log message to the browser's js console via console.log()
				"browser" => [],

				// syslog
				"syslog" => [
					"ident" => "cs"
				],

				// syslog via UDP
				"syslog_udp" => [
					"host" => "logs2.papertrailapp.com",
					"port" => "53839"
				],

			]
		],

		// For production environment
		"production" => [
			// For error AND GREATER error levels
			"error" => [
				// error_log()
				"phperror" => []
			],

			// for emergency error levels
			"emergency" => [
				"mail" => [
					"to" => "'domains@conceptual.studio'",
					"from" => "'donotreply@conceptual.studio'",
					"subject" => "[Emergency] indotrek.com"
				]
			]
		]
	],

	// search options
	"search-options" => [
		"search-tags" => true,
		"search-taxonomies" => [
			"category",
			"post_tag",
			"story_tag"
		],
		// Post types to include in search
		"post-types" => [
			"post"
		]
	],

	// Page Controllers
	"page-controllers" => [
		"Content Page" => "\\ConceptualStudio\\Controllers\\ContentPageController",
		"Default Template" => "\\ConceptualStudio\\Controllers\\DefaultController",
	],

	// CPT to model map
    // key must be equal to CPT name (config/types)
    
	"model-map" => $models,
];