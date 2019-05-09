<?php
class BootstrapJumbotron extends Component
{
	private $title, $text;
	
	function __construct(Node $parent)
	{
		parent::__construct($parent, 'div', 'jumbotron');
		
		$this->title = $this->addNode('h1', 'Hello, world!');
		$this->text = $this->addNode('p', 'This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.');
	}
	
	public function setTitle($title)
	{
		$this->title->innerText($title);
	}
	
	public function setText($text)
	{
		$this->text->innerText($text);
	}
	
	public function addButton($label, $href)
	{
		$this->createButton($label, $href, 'btn-primary btn-lg');
	}
}
?>