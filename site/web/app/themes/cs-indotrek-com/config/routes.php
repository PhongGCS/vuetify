<?php
return [
	"/api/contact-form" => [
		"controller" => "ConceptualStudio\\Controllers\\ContactController@postContactForm",
		"methods" => [
			"post"
		]
	],
	"/api/private-form" => [
		"controller" => "ConceptualStudio\\Controllers\\ContactController@postTourForm",
		"methods" => [
			"post"
		]
	],
];

/* Route examples 
return [
	// GET Route Example
	"/somePost/view/{id}" => [
		"controller" => "ConceptualStudio\\Theme\\Controllers\\SomeController@getPostPreview",
		"requirements" => [
			"id" => "\\d+"
		],
		"methods" => [
			"get"
		]
	],

	// POST Route Example
	"/somePost/{id}" => [
		"controller" => "ConceptualStudio\\Theme\\Controllers\\SomeController@postData",
		"methods" => [
			"post"
		]
	],

	// Custom function example
	'/_fix/records' => function() {
		// Your code
		vomit($output); // output something and die
	},
];
*/