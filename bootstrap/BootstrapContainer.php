<?php
class BootstrapContainer extends Component
{
	function __construct(Node $parent)
	{
		parent::__construct($parent, 'div', 'container');
	}
}
?>