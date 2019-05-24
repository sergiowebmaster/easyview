<?php
require_once 'Component.php';

class Table extends Component
{
    protected $tagName = 'table';
    
	public $tHead, $tBody, $tFoot;
	
	public function addCaption($text)
	{
	    $this->base->addNode('caption', $text);
	}
	
	private function addTHead()
	{
	    $this->tHead = $this->base->addNode('thead');
	}
	
	private function addTBody()
	{
	    $this->tBody = $this->base->addNode('tbody');
	}
	
	private function addTFoot()
	{
	    $this->tFoot = $this->base->addNode('tfoot');
	}
	
	private function checkTHead()
	{
	    if(!$this->tHead) $this->addTHead();
	}
	
	private function checkTBody()
	{
	    if(!$this->tBody) $this->addTBody();
	}
	
	private function checkTFoot()
	{
	    if(!$this->tFoot) $this->addTFoot();
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
	
	private function addRows(Node $parent, $data)
	{
	    foreach ($data as $rowData)
	    {
	        $this->addRowData($parent, $rowData);
	    }
	}
	
	public function addTHeadData($data)
	{
	    $this->checkTHead();
	    $this->addRows($this->tHead, $data);
	}
	
	public function addTBodyData($data)
	{
	    $this->checkTBody();
	    $this->addRows($this->tBody, $data);
	}
	
	public function addTFootData($data)
	{
	    $this->checkTFoot();
	    $this->addRows($this->tFoot, $data);
	}
	
	public function addColumnNames($colName1, $colName2)
	{
	    $this->addTHeadData(array(func_get_args()));
	}
	
	public function addBodyRow($td1, $td2)
	{
	    $this->addTBodyData(array(func_get_args()));
	}
	
	public function addFooterRow($td1)
	{
	    $this->addTFootData(array(func_get_args()));
	}
}
?>