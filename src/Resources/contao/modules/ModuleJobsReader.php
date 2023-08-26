<?php

namespace GeorgPreissl\Jobs;


class ModuleJobsReader extends ModuleJobs
{

	protected $strTemplate = 'mod_jobsreader';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['jobsreader'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		// Set the item from the auto_item parameter
		if (!isset($_GET['items']) && isset($_GET['auto_item']) && \Config::get('useAutoItem'))
		{
			\Input::setGet('items', \Input::get('auto_item'));
		}

		// Return an empty string if "items" is not set (to combine list and reader on same page)
		if (!\Input::get('items'))
		{
			return '';
		}


		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		$this->Template->jobs = '';

		if ($this->overviewPage)
		{
			$this->Template->referer = \PageModel::findById($this->overviewPage)->getFrontendUrl();
			$this->Template->back = $this->customLabel ?: ($GLOBALS['TL_LANG']['MSC']['jobsOverview'] ?? null);
		}
		else
		{
			$this->Template->referer = 'javascript:history.go(-1)';
			$this->Template->back = $GLOBALS['TL_LANG']['MSC']['goBack'];
		}


		// Get the job
		$objJob = JobsModel::findByIdOrAlias(\Input::get('items'));

		if ($objJob === null)
		{
			throw new \CoreBundle\Exception\PageNotFoundException('Page not found: ' . \Environment::get('uri'));
		}

		// Set the default template
		if (!$this->jobs_template)
		{
			$this->jobs_template = 'jobs_full';
		}

		$arrJobs = $this->parseJob($objJob);
		$this->Template->jobs = $arrJobs;
/*

$alias = \Input::get('items');

	    // $objJob = \JobModel::findByPk(\Input::get('items'));
		$objJob = $this->Database->prepare('SELECT * FROM tl_jobs WHERE alias = ?')->execute($alias);


		// Display a 404 page if the CD was not found
		if ($objJob === null)
		{
			global $objPage;
			$objHandler = new $GLOBALS['TL_PTY']['error_404']();
			$objHandler->generate($objPage->id);
		}

		$this->Template->title = $objJob->title;
		$this->Template->gender = $objJob->gender;
		$this->Template->location = $objJob->location;
		$this->Template->jobAdDate = $objJob->jobAdDate;
		$this->Template->text = $objJob->text;
		$this->Template->alias = $objJob->alias;
		$this->Template->shareUrl = \Environment::get('url')  . \Environment::get('path') . "/jobs-detail/" . $objJob->alias;

		$images = deserialize($objJob->photos);
		$objFiles = \FilesModel::findMultipleByUuids($images);
		$arImg = [];

		if ($objFiles) {
			
			while ($objFiles->next())
			{
			    // hier ist nun in $objFiles->path wieder das gesuchte
			$arImg[] = $objFiles->path;
			}
		}


		$this->Template->arImg = $arImg;

		$objCover = \FilesModel::findByPk($objJob->photos);

		// Add cover image
		if ($objCover !== null)
		{
			$this->Template->photo = \Image::getHtml(\Image::get($objCover->path, '100', '100', 'center_center'));
		}

        $objSongs = \JobSongModel::findByParent($objJob->id);

		// Return if there are no songs
		if ($objSongs === null)
		{
			return;
		}

		$count = 0;
		$arrSongs = array();

		// Generate songs
		while ($objSongs->next())
		{
			$arrSongs[] = array
			(
				'number' => ++$count,
				'title' => $objSongs->title,
				'duration' => $objSongs->duration
			);
		}

		$this->Template->songs = $arrSongs;
		$this->Template->numberLabel = $GLOBALS['TL_LANG']['MSC']['song_number'];
		$this->Template->titleLabel = $GLOBALS['TL_LANG']['MSC']['song_title'];
		$this->Template->durationLabel = $GLOBALS['TL_LANG']['MSC']['song_duration'];

*/

	}
}
