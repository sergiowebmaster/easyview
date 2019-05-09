<?php
class BootstrapHorizontalForm extends BootstrapForm
{
	public $labelSize = 4;
	
	function __construct($parent, $action, $method = 'post')
	{
		parent::__construct($parent, $action, $method);
		$this->setClass('form-horizontal');
	}
	
	public function addGroup($label, $for, $size = 12)
	{
		$row = $this->fieldset->addNode('div');
		$row->setClass('form-group');
		
		$labelNode = $this->createLabel($row, $label, $for);
		$labelNode->setClass('col-sm-' . $this->labelSize . ' control-label');
		
		$div = $row->addNode('div');
		$div->setClass('col-sm-' . (12 - $this->labelSize));

		return $div;
	}
}
?>