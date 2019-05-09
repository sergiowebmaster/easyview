<?php
class FacebookLikeButton extends FacebookButton
{
	function __construct(Node $parent, $url)
	{
		parent::__construct($parent, 'fb-like', $url);
		
		$this->setAction('like');
		$this->setStandardLayout();
	}
	
	public function setAction($action)
	{
		$this->attr('data-action', $action);
	}
	
	public function setReference($reference)
	{
		$this->attr('data-ref', $reference);
	}
	
	public function share()
	{
		$this->attr('data-share', true);
	}
}
?>