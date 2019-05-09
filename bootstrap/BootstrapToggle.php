<?php
class BootstrapToggle
{
	protected static $type;
	
	const TOP = 'top';
	const LEFT = 'left';
	const RIGHT = 'right';
	const BOTTOM = 'bottom';
	
	public static function init(Page $page, $options = '')
	{
		$page->addJsCode('$(function () {$(\'[data-toggle="'.static::$type.'"]\').'.static::$type.'({'.$options.'})})');
	}

	function __construct(Node $parent, $title, $direction = self::TOP)
	{
		$parent->attrs(array('data-toggle' => static::$type, 'data-placement' => $direction, 'title' => $title));
	}
}