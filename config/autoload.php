<?php

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Models
	'Contao\JobModel'        => 'system/modules/jobs/models/JobModel.php',
	'Contao\JobSongModel'    => 'system/modules/jobs/models/JobSongModel.php',
	
	// Modules
	'Contao\ModuleJobList'   => 'system/modules/jobs/modules/ModuleJobList.php',
	'Contao\ModuleJobReader' => 'system/modules/jobs/modules/ModuleJobReader.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_joblist'   => 'system/modules/jobs/templates/modules',
	'mod_jobreader' => 'system/modules/jobs/templates/modules'
));
