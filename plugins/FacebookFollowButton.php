<?php
class FacebookFollowButton extends FacebookButton
{
	function __construct(Node $parent, $profile)
	{
		parent::__construct($parent, 'fb-follow', $this->getUrl($profile));
		
		$this->setColorScheme('light');
		$this->enableForKids(false);
		$this->setStandardLayout();
		$this->showFaces(false);
	}
	
	private function setColorScheme($scheme)
	{
		$this->attr('data-colorscheme', $scheme);
	}
	
	public function setDarkScheme()
	{
		$this->setColorScheme('dark');
	}
	
	public function enableForKids($boolean = true)
	{
		$this->attrBool('data-kid-directed-site', $boolean);
	}
	
	public function showFaces($boolean = true)
	{
		$this->attrBool('data-show-faces', $boolean);
	}
}
?>