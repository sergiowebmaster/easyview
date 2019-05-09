<?php
class BootstrapNavbar extends Component
{
	private $menuID = '';
	private $container, $menu;
	private $links = array();
	
	public $brand;
	
	function __construct(Node $parent, $menuID = 'nav-menu')
	{
		parent::__construct($parent, 'nav', 'navbar navbar-default');
		
		$this->menuID = $menuID;
		
		$this->container = $this->addNode('div');
		$this->container->setClass('container-fluid');
		
		$header = $this->container->addNode('div');
		$header->setClass('navbar-header');
		
		$toggle = $header->addNode('button');
		$toggle->setClass('navbar-toggle collapsed');
		$toggle->attr('type', 'button');
		$toggle->attr('data-toggle', 'collapse');
		$toggle->attr('data-target', '#' . $this->menuID);
		$toggle->attr('aria-expanded', 'false');
		
		$toggle->addNode('span')->setClass('sr-only');
		$toggle->addNode('span')->setClass('icon-bar');
		$toggle->addNode('span')->setClass('icon-bar');
		$toggle->addNode('span')->setClass('icon-bar');
		
		$this->brand = $header->addNode('a');
		$this->brand->setClass('navbar-brand');
		
		$this->content = $this->container->addNode('div');
		$this->content->setId($this->menuID);
		$this->content->setClass('collapse navbar-collapse');
		
		$this->addMenu();
	}
	
	public function setBrandHref($href)
	{
		$this->brand->attr('href', $href);
	}
	
	public function setBrandImage($src)
	{
		$this->brand->img('Brand', $src);
	}
	
	public function addMenu($direction = '')
	{
		$this->menu = $this->content->addNode('ul');
		$this->menu->setClass('nav navbar-nav');
		
		if($direction) $this->menu->addClass('navbar-' . $direction);
	}
	
	public function addMenuLeft()
	{
		$this->addMenu('left');
	}
	
	public function addMenuRight()
	{
		$this->addMenu('right');
	}
	
	private function createLink(Node $parent, $label, $href)
	{
		$li = $parent->addNode('li');
			
		$a = $li->addNode('a', $label);
		$a->attr('href', $href);
	}
	
	public function addLink($label, $href)
	{
		$this->createLink($this->menu, $label, $href);
	}
	
	public function addDropdownLink($label, $links, $baseURI = '')
	{
		return new BootstrapDropdown($this->menu->addNode('li'), $label, $links, $baseURI);
	}
	
	public function addLinks($links)
	{
		foreach ($links as $label => $href)
		{
			if(is_string($href))
			{
				$this->addLink($label, $href);
			}
			else if(is_array($href))
			{
				$this->addDropdownLink($label, $href);
			}
		}
	}
	
	public function addToRight($tagName, $value)
	{
		$node = $this->addNode($tagName, $value);
		$node->setClass('navbar-right');
		
		return $node;
	}
	
	public function getLinks()
	{
		return $this->links;
	}
}
?>