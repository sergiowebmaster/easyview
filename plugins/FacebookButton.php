<?php
class FacebookButton extends FacebookPlugin
{
	function __construct(Node $parent, $class, $href)
	{
		parent::__construct($parent, 'div', $class);
	
		$this->setHref($href);
		$this->setLayout('icon_link');
		$this->setSize('small');
	}

	public function setLayout($layout)
	{
		$this->attr('data-layout', $layout);
	}
	
	public function setStandardLayout()
	{
		$this->setLayout('standard');
	}
	
	public function useButton()
	{
		$this->setLayout('button');
	}
	
	public function useButtonCount()
	{
		$this->setLayout('button_count');
	}
	
	public function useBoxCount()
	{
		$this->setLayout('box_count');
	}
	
	private function setSize($size)
	{
		$this->attr('data-size', $size);
	}
	
	public function toLarge()
	{
		$this->setSize('large');
	}
}
?>