<?php

namespace GeorgPreissl\Jobs;


class ModuleJobsList extends ModuleJobs
{


	protected $strTemplate = 'mod_jobslist';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['jobslist'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		
		$objJobs = JobsModel::findBy('published', 1);



		if ($objJobs !== null)
		{

			$arrCompanies = array(
				'baugruppe', 
				'hochbau', 
				'dachbau',
				'holzbau',
				'fsp-metalltechnik',
				'fsp-begruenung'
			);
			$arrCompaniesOptions = array();
			foreach($arrCompanies as $company){
				// dump($company);
				if(JobsModel::countBy('company', $company)){
					$arrCompaniesOptions[] = $company;
				}
			}

			$arrPlaces = array(
				'frankenburg', 
				'steinhaus',
				'timelkam',
				'holzhausen',
				'regau',
				'muenchendorf'
			);
			$arrPlacesOptions = array();
			foreach($arrPlaces as $place){
				// dump($place);
				if(JobsModel::countBy('place', $place)){
					$arrPlacesOptions[] = $place;
				}
			}

			$arrWorkingTimeModels = array(
				'vollzeit',
				'teilzeit'
			);
			$arrWorkingTimeModelsOptions = array();
			foreach($arrWorkingTimeModels as $WorkingTimeModel){
				if(JobsModel::countBy('workingTimeModel', $WorkingTimeModel)){
					$arrWorkingTimeModelsOptions[] = $WorkingTimeModel;
				}
			}


			



			$this->Template->companiesOptions = $arrCompaniesOptions;
			$this->Template->placesOptions = $arrPlacesOptions;
			$this->Template->workingTimeModelsOptions = $arrWorkingTimeModelsOptions;
			$this->Template->jobs = $this->parseJobs($objJobs);
		}


/*
		$objJobs = $this->Database->prepare("SELECT * FROM tl_jobs WHERE published=? ORDER BY tstamp DESC")->execute(1);

		// Return if no jobs were found
		if ($objJobs === null)
		{
			return;
		}


		$strLink = '';

		// Generate a jumpTo link
		if ($this->jumpTo > 0)
		{
			$objJump = \PageModel::findByPk($this->jumpTo);

			if ($objJump !== null)
			{
				// $strLink = $this->generateFrontendUrl($objJump->row(), '/items/%s');
				$strLink = $this->generateFrontendUrl($objJump->row(), '/%s');
			}
		}

		$arrJobs = array();

		// Generate jobs
		while ($objJobs->next())
		{
			$strCover = '';
			$objCover = \FilesModel::findByPk($objJobs->photos);

			// Add cover image
			if ($objCover !== null)
			{
				$strCover = \Image::getHtml(\Image::get($objCover->path, '100', '100', 'center_center'));
			}
// dump($objJobs);
			$arrJobs[] = array
			(
				'title' => $objJobs->title,
				'gender' => $objJobs->gender,
				'company' => $objJobs->company,
				'location' => $objJobs->location,
				'workingTimeModel' => $objJobs->workingTimeModel ? : 'vollzeit',
				'jobAdDate' => $objJobs->jobAdDate,
				'entryDate' => $objJobs->entryDate,
				'teaserText' => $objJobs->teaserText,
				'photos' => $strCover,
				'text' => $objJobs->text,
				// 'link' => strlen($strLink) ? sprintf($strLink, $objJobs->id) : ''
				'link' => strlen($strLink) ? sprintf($strLink, $objJobs->alias) : ''
			);
		}

		$this->Template->jobs = $arrJobs;


*/

	}
}