<?php
require_once 'Component.php';

class Table extends Component
{
	private $tHead, $tBody, $tFoot, $tr;
	
	function __construct(Node $parent)
	{
		parent::__construct($parent, 'table', '');
		
		$this->tHead = $this->addNode('thead');
		$this->tBody = $this->addNode('tbody');
	}
	
	public function addTFoot()
	{
		$this->tFoot = $this->addNode('tfoot');
	}
	
	private function addRow(Node $parent, $data)
	{
		$this->tr = $parent->addNode('tr');
		$th = $parent === $this->tHead;
			
		foreach ($data as $arg)
		{
			if($th) $this->addTh($arg);
			else $this->addTd($arg);
		}
		
		return $this->tr;
	}
	
	private function addCol($tagName, $text, $colSpan)
	{
		$td = $this->tr->addNode($tagName, $text);
		
		if($colSpan > 1) $td->attr('colspan', $colSpan);
		
		return $td;
	}
	
	public function addTh($columnName, $colSpan = 1)
	{
		return $this->addCol('th', $columnName, $colSpan);
	}
	
	public function addTd($text, $colSpan = 1)
	{
		return $this->addCol('td', $text, $colSpan);
	}
	
	public function addTdLink($href, $text)
	{
		return $this->addTd('')->a($href, $text);
	}
	
	public function addHeadTr($th1 = '')
	{
		return $this->addRow($this->tHead, func_get_args());
	}
	
	public function addBodyTr($td1 = '')
	{
		return $this->addRow($this->tBody, func_get_args());
	}
	
	public function addFootTr($td1 = '')
	{
		return $this->addRow($this->tFoot, func_get_args());
	}
}
?>