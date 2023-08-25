<?php

/**
 * Table tl_jobs
 */
$GLOBALS['TL_DCA']['tl_jobs'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		// 'ctable'                      => array('tl_jobs_song'),
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit'
		),
		// 'sorting' => array
		// (
		// 	'mode'                    => 4,
		// 	'fields'                  => array('sorting'),
		// 	'headerFields'            => array('title'),
		// 	'panelLayout'             => 'search,limit',
		// 	'child_record_callback'   => array('tl_jobs', 'generatejobRow')
		// ),
		'label' => array
		(
			'fields'                  => array('title', 'location'),
			'format'                  => '%s <span style="color:#b3b3b3;padding-left:3px;">[%s]</span>'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			// 'edit' => array
			// (
			// 	'label'               => &$GLOBALS['TL_LANG']['tl_jobs']['edit'],
			// 	'href'                => 'table=tl_jobs_song',
			// 	'icon'                => 'edit.gif'
			// ),
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jobs']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jobs']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jobs']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null ) . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jobs']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_jobs', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jobs']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{data_legend},title,alias,gender,company,location,workingTimeModel,jobAdDate,entryDate;{content_legend},teaserText,text,photos'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['alias'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'alias', 'unique'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
				array('tl_jobs', 'generateAlias')
			),
			'sql'                     => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
		),
		'gender' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['gender'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'company' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['company'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => ['hochbau', 'dachbau', 'holzbau'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(64) COLLATE ascii_bin NOT NULL default ''"
		),
		'location' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['location'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'workingTimeModel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['workingTimeModel'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => ['vollzeit', 'teilzeit'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(64) COLLATE ascii_bin NOT NULL default ''"
		),
		'jobAdDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['jobAdDate'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'entryDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['entryDate'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'teaserText' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['teaserText'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE'),
			'sql'                     => "text NULL"
		),
		'photos' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['photos'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array(
											'fieldType'=>'checkbox',
											'multiple'=>true,
											'files'=>true,
											'filesOnly'=>true, 
											'extensions'=>$GLOBALS['TL_CONFIG']['validImageTypes']
										),
			'sql'                     => "blob NULL",
		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['text'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE'),
			'sql'                     => "text NULL"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_faq']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 2,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);








class tl_jobs extends Backend
{



	public function generatejobRow($arrRow)
	{
		return '<div>' . $arrRow['title'] . ' <span style="padding-left:3px;color:#b3b3b3;">[' . $arrRow['title'] . ']</span></div>';
	}


	/**
	 * Auto-generate the FAQ alias if it has not been set yet
	 *
	 * @param mixed         $varValue
	 * @param DataContainer $dc
	 *
	 * @return mixed
	 *
	 * @throws Exception
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = StringUtil::generateAlias($dc->activeRecord->title);
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_jobs WHERE alias=?")
								   ->execute($varValue);

		// Check whether the news alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}




   /**
     * Ändert das Aussehen des Toggle-Buttons.
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        $this->import('BackendUser', 'User');

        if (strlen($this->Input->get('tid')))
        {
            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_jobs::published', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;id='.$this->Input->get('id').'&amp;tid='.$row['id'].'&amp;state='.$row[''];

        if (!$row['published'])
        {
            $icon = 'invisible.gif';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
    }



	/**
	 * Toggle the visibility of an element
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnPublished)
	{
	    // Check permissions to publish
	    if (!$this->User->isAdmin && !$this->User->hasAccess('tl_jobs::published', 'alexf'))
	    {
	        $this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_jobs toggleVisibility', TL_ERROR);
	        $this->redirect('contao/main.php?act=error');
	    }

	    $this->createInitialVersion('tl_jobs', $intId);

	    // Trigger the save_callback
	    if (is_array($GLOBALS['TL_DCA']['tl_jobs']['fields']['published']['save_callback']))
	    {
	        foreach ($GLOBALS['TL_DCA']['tl_jobs']['fields']['published']['save_callback'] as $callback)
	        {
	            $this->import($callback[0]);
	            $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
	        }
	    }

	    // Update the database
	    $this->Database->prepare("UPDATE tl_jobs SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")
	        ->execute($intId);
	    $this->createNewVersion('tl_jobs', $intId);
	}






}
