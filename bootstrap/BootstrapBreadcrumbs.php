<?php
class BootstrapBreadcrumbs extends Component
{
	function __construct(Node $parent, $data = array())
	{
		parent::__construct($parent, 'ol', 'breadcrumb');
		
		$slugs = $data? $data : explode('/', $_SERVER['REQUEST_URI']);
		$path = '';
		
		foreach ($slugs as $label => $slug)
		{
			$path .= $slug . '/';
			$this->addNode('li')->a($path, is_numeric($label)? $slug : $label);
		}
	}
}
?>