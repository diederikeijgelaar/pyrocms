<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sitemap module public controller
 * Renders a human-readable sitemap with all public pages and blog categories
 * Also renders a machine-readable sitemap for search engines
 * @author  	Barnabas Kendall <barnabas@bkendall.biz>
 * @license 	Apache License v2.0
 * @version 	1.1
 */
class Sitemap extends Public_Controller
{	
	/**
	 * Constructor method; load the pages array
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		
	}

	/**
	 * XML method - output sitemap in XML format for search engines
	 * @access public
	 * @return void
	 */
	public function xml()
	{
		$doc = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');
		
		// first get a list of enabled modules, use them for the listing
		$modules = $this->module_m->get_all(array('is_frontend' => 1));

		foreach ($modules as $module)
		{
			// To understand recursion, you must first understand recursion
			if ($module['slug'] == 'sitemap')
			{
				continue;
			}

			// TODO: Fix for shared addons. Add path like themes?
			$path = $module['is_core'] ? APPPATH : FCPATH.ADDONPATH;

			if ( ! file_exists($path.'modules/'.$module['slug'].'/controllers/sitemap.php'))
			{
				continue;
			}

			$doc->addChild('sitemap')
				->addChild('loc', site_url($module['slug'].'/sitemap/xml'));
		}
		
		$this->output
			->set_content_type('application/xml')
			->set_output($doc->asXML());
	}
	
}
