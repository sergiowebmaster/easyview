<?php
class BootstrapPage extends Page
{
	public function addBootstrap($path, $version = '')
	{
		if($version) $path .= 'bootstrap-' . $version . '-dist/';
		
		$this->addCSS($path . 'css/bootstrap.min.css');
		$this->addJS($path . 'js/bootstrap.min.js');
	}
}
?>