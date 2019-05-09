<?php
require_once 'FacebookPlugin.php';

class FacebookPagePlugin extends FacebookPlugin
{
	function __construct(Node $parent, $uri, $name)
	{
		parent::__construct($parent, 'div', 'fb-page');
		
		$url = $this->getUrl($uri);
		
		$this->setHref($url);
		$this->hideCover(false);
		$this->smallHeader(false);
		$this->renderTabs(true, false, false);
		$this->showFacepile(true);
		$this->adaptWidth();
		
		$blockquote = $this->addNode('blockquote');
		$blockquote->attr('cite', $url);
		$blockquote->attr('class', 'fb-xfbml-parse-ignore');
		$blockquote->a($url, $name);
	}
	
	public function hideCover($boolean = true)
	{
		$this->attrBool('data-hide-cover', $boolean);
	}
	
	public function renderTabs($timeline, $messages, $events)
	{
		$tabs = array();
		
		if($timeline) 	$tabs[] = 'timeline';
		if($messages) 	$tabs[] = 'messages';
		if($events)		$tabs[] = 'events';
		
		$this->attr('data-tabs', join(', ', $tabs));
	}
	
	public function showFacepile($show)
	{
		$this->attrBool('data-show-facepile', $show);
	}
	
	public function hideCTA($boolean)
	{
		$this->attrBool('data-hide-cta', $boolean);
	}
	
	public function smallHeader($boolean = true)
	{
		$this->attrBool('data-small-header', $boolean);
	}
	
	public function adaptWidth($boolean = true)
	{
		$this->attrBool('data-adapt-container-width', $boolean);
	}
}
?>