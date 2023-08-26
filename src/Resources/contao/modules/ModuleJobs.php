<?php

namespace GeorgPreissl\Jobs;

use Contao\Module;


abstract class ModuleJobs extends \Module
{

	public function parseJobs($objJobs)
	{
		$arrJobs = array();

		foreach ($objJobs as $objJob)
		{
			$arrJobs[] = $this->parseJob($objJob);
		}

		return $arrJobs;
	}

	public function parseJob($objJob,$strClass='')
	{

		$objTemplate = new \FrontendTemplate($this->jobs_template ?: 'jobs_short');
		$objTemplate->setData($objJob->row());

		if ($objJob->cssClass)
		{
			$strClass = ' ' . $objJob->cssClass . $strClass;
		}

		$objTemplate->class = $strClass;

		if(isset($this->jumpTo) && $this->jumpTo ==! 0)
		{
			$objPage = \PageModel::findByPk($this->jumpTo);
			$strParams = (\Config::get('useAutoItem') ? '/' : '/items/') . ($objJob->alias ?: $objJob->id);
			$objTemplate->link = \StringUtil::ampersand($objPage->getFrontendUrl($strParams));
		}

		$figureBuilder = \System::getContainer()
		->get('contao.image.studio')
		->createFigureBuilder()
		->from($objJob->singleSRC)
		->setSize($this->imgSize);

		if (null !== ($figure = $figureBuilder->buildIfResourceExists()))
		{
			$figure->applyLegacyTemplateData($objTemplate, $objJob->imagemargin, $objJob->floating);
		}	

		// schema.org information
		$objTemplate->getSchemaOrgData = static function () use ($objTemplate, $objJob): array
		{
			$jsonLd = StaffFrontend::getSchemaOrgData($objJob);

			if ($objTemplate->addImage && $objTemplate->figure)
			{
				$jsonLd['image'] = $objTemplate->figure->getSchemaOrgData();
			}

			return $jsonLd;
		};

		return $objTemplate->parse(); 

	}
}
