<?php
require_once 'Node.php';

class Component extends Node
{
	public $content;
	
	function __construct(Node $parent, $tagName, $cssClass)
	{
		parent::__construct($tagName);
		$parent->add($this);
		$this->setClass($cssClass);
		$this->content = $this;
	}
	
	public function addScript($code)
	{
		$this->parent->addNode('script', $code)->attr('type', 'text/javascript');
	}
}
?>