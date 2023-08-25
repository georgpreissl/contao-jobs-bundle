<?php

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 1, array
(
	'jobs' => array
	(
		'tables' => array('tl_jobs', 'tl_jobs_song'),
		'icon'   => 'system/modules/jobs/assets/icon.png'
	)
));


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['job_list']   = 'ModuleJobList';
$GLOBALS['FE_MOD']['miscellaneous']['job_reader'] = 'ModuleJobReader';


/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_jobs']      = 'JobModel';
$GLOBALS['TL_MODELS']['tl_jobs_song'] = 'JobSongModel';


$GLOBALS['TL_HOOKS']['getSearchablePages'][] = array('ModuleJobList', 'myGetSearchablePages');

