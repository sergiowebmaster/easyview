<?php
class BootstrapNavs extends Component
{
	private $links = array();
	
	public $index = '';
	
	const PILLS = 'nav-pills';
	const STACKED = 'nav-pills nav-stacked';
	const TABS = 'nav-tabs';
	
	function __construct(Node $parent, $type = self::PILLS)
	{
		parent::__construct($parent, 'ul', 'nav ' . $type);
	}
	
	public function addLink($label, $href)
	{
		$li = $this->addNode('li');
		$li->attr('role', 'presentation');
		
		if($href == $this->index) $li->setClass('active');
		
		$a = $li->a($href, $label);
	}
	
	public function addLinks($links)
	{
		foreach ($links as $label => $href)
		{
			$this->addLink($label, $href);
		}
	}
}
?>