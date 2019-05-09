<?php
class BootstrapDropdown extends Component
{
	function __construct(Node $parent, $label, $links, $baseURI = '')
	{
		parent::__construct($parent, 'ul', 'dropdown-menu');

		$parent->setClass('dropdown');
		
		$toggle = $parent->a('', $label);
		$toggle->addNode('span')->setClass('caret');
		$toggle->attrs(array(
				'role' => 'button',
				'class' => 'dropdown-toggle',
				'data-toggle' => 'dropdown',
				'aria-haspopup' => 'true',
				'aria-expanded' => 'false'));
		
		foreach ($links as $title => $href)
		{
			$this->addNode('li')->a($baseURI . $href, $title);
		}
	}
}
?>