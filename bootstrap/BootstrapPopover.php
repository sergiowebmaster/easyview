<?php
class BootstrapPopover extends BootstrapToggle
{
	protected static $type = 'popover';
	
	function __construct(Node $parent, $title, $content, $label = '')
	{
		parent::__construct($parent, $title);
		$parent->attr('data-content', $content);
		$parent->innerText($label);
	}
}
?>