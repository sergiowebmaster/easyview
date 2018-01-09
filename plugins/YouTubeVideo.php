<?php
class YouTubeVideo extends Component
{
	function __construct($parent, $code, $autoplay = false)
	{
		parent::__construct($parent, 'iframe', 'video');
		
		$this->attr('src', 'https://www.youtube.com/embed/' . $code . '?autoplay=' . ($autoplay? '1' : '0'));
		$this->attr('frameborder', '0');
		$this->attr('allowfullscreen', 'true');
	}
	
	public function setDimensions($width, $height)
	{
		$this->setStyle('width:' . $width . '; height:' . $height);
	}
}
?>