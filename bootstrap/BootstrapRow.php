<?php
class BootstrapRow extends Component
{
	private $cols = 12;
	
	function __construct(Node $parent, $fluid = false)
	{
		parent::__construct($parent, 'div', $fluid? 'row-fluid' : 'row');
	}
	
	public function addCol($size)
	{
		$col = $this->addNode('div');
		$col->attr('class', 'col-md-' . $size);
		
		$this->cols -= $size;
		
		return $col;
	}
	
	public function addColFull()
	{
		return $this->addCol($this->cols);
	}
	
	public static function createList(Node $parent, $arrayData, $labelSize = 3)
	{
		$contentSize = 12 - $labelSize;
		
		foreach ($arrayData as $label => $text)
		{
			$row = new self($parent);
			$row->addCol($labelSize)->strong($label);
			$row->addCol($contentSize)->addTextNode($text);
		}
	} 
}