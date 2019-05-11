<?php
require_once 'Component.php';

class Table extends Component
{
    protected $tagName = 'table';
    
	public $tHead, $tBody, $tFoot;
	
	protected function createStructure()
	{
	    $this->tHead = $this->base->addNode('thead');
	    $this->tBody = $this->base->addNode('tbody');
	}
	
	private function addRowData(Node $parent, $rowData)
	{
	    $tr = $parent->addNode('tr');
	    
	    foreach ($rowData as $value)
	    {
	        $tr->addNode($parent->getName() == 'thead'? 'th' : 'td', $value);
	    }
	    
	    return $tr;
	}
	
	private function addData(Node $parent, $data)
	{
	    foreach ($data as $rowData)
	    {
	        $this->addRowData($parent, $rowData);
	    }
	}
	
	public function addColumnNames($colName1, $colName2)
	{
	    $this->addRowData($this->tHead, func_get_args());
	}
	
	public function addBodyData($data)
	{
	    $this->addData($this->tBody, $data);
	}
	
	public function addBodyRow($td1, $td2)
	{
	    $this->addRowData($this->tBody, func_get_args());
	}
	
	public function addFooter()
	{
	    $this->tFoot = $this->base->addNode('tfoot');
	}
	
	public function addFooterData($data)
	{
	    if($this->tFoot) $this->addData($this->tFoot, $data);
	}
	
	public function addCaption($text)
	{
	    $this->base->addNode('caption', $text);
	}
}
?>