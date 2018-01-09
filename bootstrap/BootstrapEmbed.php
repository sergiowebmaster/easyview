<?php
class BootstrapEmbed extends Component
{
	private $iframe;
	
	function __construct(Node $parent)
	{
		parent::__construct($parent, 'div', 'embed-responsive');
		$this->setRatio16x9();
		
		$this->iframe = $this->addNode('iframe');
		$this->iframe->setClass('embed-responsive-item');
		$this->iframe->setStyle('background:#000;');
	}
	
	public function setIframeID($id)
	{
		$this->iframe->setId($id);
	}
	
	protected function setRatio($ratio)
	{
		$this->setClass('embed-responsive embed-responsive-' . $ratio);
	}
	
	public function setRatio16x9()
	{
		$this->setRatio('16by9');
	}
	
	public function setRatio4x3()
	{
		$this->setRatio('4by3');
	}
	
	public function setSrc($src)
	{
		$this->iframe->attr('src', $src);
	}
	
	public function setYouTubeSrc($code)
	{
		$this->setSrc('//www.youtube.com/embed/' . $code . '?rel=0');
	}
}
?>