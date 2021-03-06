<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Keywords extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Keywords',
				'ar' => 'Keywords',
				'pt' => 'Palavras-chave'
			),
			'description' => array(
				'en' => 'Maintain a central list of keywords to label and organize your content.',
				'ar' => 'Maintain a central list of keywords to label and organize your content.',
				'pt' => 'Mantém uma lista central de palavras-chave para rotular e organizar o seu conteúdo.'
			),
			'frontend' => FALSE,
			'backend'  => TRUE,
			'menu'     => 'content'
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('keywords');
		$this->dbforge->drop_table('keywords_applied');

		$keywords = "
			CREATE TABLE " . $this->db->dbprefix('keywords') . " (
			  `id` int unsigned NOT NULL AUTO_INCREMENT,
			  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		";
		
		$keywords_applied = "
			CREATE TABLE " . $this->db->dbprefix('keywords_applied') . " (
			  `id` int unsigned NOT NULL AUTO_INCREMENT,
			  `hash` char(32) NOT NULL,
			  `keyword_id` int unsigned COLLATE utf8_unicode_ci NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB;
		";

		if ($this->db->query($keywords) && $this->db->query($keywords_applied))
		{
			return TRUE;
		}
	}

	public function uninstall()
	{
		//it's a core module, lets keep it around
		return FALSE;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return TRUE;
	}
}

/* End of file details.php */