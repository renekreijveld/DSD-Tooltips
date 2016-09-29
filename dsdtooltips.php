<?php

/*
# -------------------------------------------------------------------------
# dsdtooltips
# -------------------------------------------------------------------------
# author     	DSD Business Internet
# copyright  	Copyright (C) 2016 DSD Business Internet. All Rights Reserved.
# licenses		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
# Websites:		https://www.dsdbusinessinternet.nl
# -------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgSystemDsdtooltips extends JPlugin
{
	public function onAfterRender()
	{
		// Only continue in the frontend
		$application = JFactory::getApplication();

		if ($application->isSite() == false)
		{
			return false;
		}

		$body = JResponse::getBody();
		$pattern = '`{tooltip(.*?)}`';
		$replacement = '';

		while (preg_match($pattern, $body) == 1)
		{
			preg_match($pattern, $body, $matches);
			$par = substr($matches[0], 9, -1);
			$par1 = explode('|', $par);
			for($x=0; $x < count($par1); $x++)
			{
				$pn = strstr($par1[$x], '=', true);
				switch($pn)
				{
					case 'linktext':
					$linktext = substr(strstr($par1[$x], '='), 1);
					break;
					case 'tiptitle':
					$tiptitle = substr(strstr($par1[$x], '='), 1);
					break;
					case 'trigger':
					$trigger = substr(strstr($par1[$x], '='), 1);
					break;
					case 'tiptext':
					$tiptext = substr(strstr($par1[$x], '='), 1);
					$tiptext = str_replace('"', '\'', $tiptext);
					break;
					case 'showdelay':
					$showdelay = substr(strstr($par1[$x], '='), 1);
					break;
					case 'hidedelay':
					$hidedelay = substr(strstr($par1[$x], '='), 1);
					break;
				}
			}

			// Set default values for some parameters
			if (empty($trigger)) $trigger = $this->params->get('trigger');
			if (empty($showdelay)) $showdelay = $this->params->get('showdelay');
			if (empty($hidedelay)) $hidedelay = $this->params->get('hidedelay');

			if ($trigger == "click")
			{
				$showdelay = "0";
				$hidedelay = "0";
			}

			$replacement = '<a class="ttip" title="';
			if ($tiptitle) $replacement .= '<h3>' . $tiptitle . '</h3>';
			$replacement .=  $tiptext . '" data-toggle="tooltip" data-delay=\'{"show":"' . $showdelay . '", "hide":"' . $hidedelay . '"}\' data-placement="auto" data-html="true" data-trigger="' . $trigger . '">' . $linktext . '</a>';

			$body = str_replace($matches[0], $replacement, $body);
			$linktext = '';
			$tiptitle = '';
			$trigger = '';
			$tiptext = '';
		}

		JResponse::setBody($body);
		return true;
	}

	public function onAfterInitialise()
	{
		// Only continue in the frontend
		$application = JFactory::getApplication();

		if ($application->isSite() == false)
		{
			return false;
		}

		$document = JFactory::getDocument();
		$document->addScript("/plugins/system/dsdtooltips/assets/starttooltips.js");

	}

}