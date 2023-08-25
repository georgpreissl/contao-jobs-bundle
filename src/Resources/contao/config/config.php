<?php

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 1, array
(
	'jobs' => array
	(
		'tables' => array('tl_jobs')
	)
));


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['joblist']   = 'GeorgPreissl\Jobs\ModuleJobList';
$GLOBALS['FE_MOD']['miscellaneous']['jobreader'] = 'GeorgPreissl\Jobs\ModuleJobReader';


/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_jobs']      = 'GeorgPreissl\Jobs\JobsModel';


// $GLOBALS['TL_HOOKS']['getSearchablePages'][] = array('ModuleJobList', 'myGetSearchablePages');

