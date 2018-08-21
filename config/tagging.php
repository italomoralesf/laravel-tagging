<?php

return [
	// Value of are passed through this before save of tags
	'normalizer' => '\Italomoralesf\Tagging\Util::slug',
	
	// Display value of tags are passed through (for front end display)
	'displayer' => '\Illuminate\Support\Str::title',
	
	// Database connection for Italomoralesf\Taggable\Tag model to use
// 	'connection' => 'mysql',
	
	// When deleting a model, remove all the tags first
	'untag_on_delete' => true,
		
	// Auto-delete unused tags from the 'tags' database table (when they are used zero times)
	'delete_unused_tags'=>true,

	// Model to use to store the tags in the database
	'tag_model'=>'\Italomoralesf\Tagging\Model\Tag',

	// Delimiter used within tags
	'delimiter' => '-',
	
	// Model to use for the relation between tags and tagged records
	'tagged_model' => '\Italomoralesf\Tagging\Model\Tagged',
];
