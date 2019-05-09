<?php
class BootstrapForm extends Form
{
	protected $row;
	
	public $lastGroup;
	public $lineSize = 120;
	
	public function inline()
	{
		$this->setClass('form form-inline');
	}
	
	protected function formatInput(Node $input, $name, $placeholder)
	{
		parent::formatInput($input, $name, $placeholder);
		
		$input->setId($name);
		
		switch ($input->getAttribute('type'))
		{
			case 'checkbox':
			case 'radio':
				break;
				
			default:
				$input->setClass('form-control');
		}
		
		return $input;
	}
	
	public function addRow()
	{
		$this->row = new BootstrapRow($this->fieldset);
	}
	
	private function addCol($size)
	{
		return $this->row->addCol(round(($size / $this->lineSize) * 12));
	}
	
	public function addGroup($label, $for, $size = 12)
	{
		$this->lastGroup = $this->row? $this->addCol($size) : $this->fieldset->addNode('div');
		$this->lastGroup->addClass('form-group');
		
		$labelTag = $this->lastGroup->addNode('label', $label);
		$labelTag->attr('for', $for);
		
		return $this->lastGroup;
	}
	
	public function addGroupText($label, $name, $placeholder, $size, $maxlength, $value = '')
	{
		$group = $this->addGroup($label, $name, $size);
		return $this->createInput($group, 'text', $name, $placeholder, $value, $size, $maxlength);
	}
	
	public function addGroupPassword($label, $name, $placeholder, $size = 8, $maxlength = 10, $value = '')
	{
		$group = $this->addGroup($label, $name, $size);
		return $this->createInput($group, 'password', $name, $placeholder, $value, $size, $maxlength);
	}
	
	public function addGroupFile($label, $name, $size, $accept, $multiple = false)
	{
		$group = $this->addGroup($label, $name, $size);
		return $this->createInputFile($group, $name, $size, $accept, $multiple);
	}
	
	private function createChooseGroup($label, $type, $name, $size, $data)
	{
		$group = $this->addGroup($label, $name, $size);
		
		foreach ($data as $value => $label)
		{
			$div = $group->addNode('div');
			$div->setClass($type);
			
			$this->createChooseInput($div->addNode('label'), $type, $name, $value, $label);
		}
		
		return $group;
	}
	
	public function addGroupRadio($label, $name, $size, $data)
	{
		return $this->createChooseGroup($label, 'radio', $name, $size, $data);
	}
	
	public function addGroupCheckbox($label, $name, $size, $data)
	{
		return $this->createChooseGroup($label, 'checkbox', $name, $size, $data);
	}
	
	public function addGroupSelect($label, $name, $size, $options, $value = '')
	{
		$group = $this->addGroup($label, $name, $size);
		return $this->createSelect($group, $name, $options, $value);
	}
	
	public function addGroupTextarea($label, $name, $placeholder, $cols, $rows = 5, $value = '')
	{
		$group = $this->addGroup($label, $name, $cols);
		return $this->createTextarea($group, $name, $rows, $cols, $placeholder, $value);
	}
	
	public function addButton($value, $name = '', $isSubmit = false)
	{
		$btn = parent::addButton($value, $name);
		$btn->setClass('btn btn-' . ($name || $isSubmit? 'primary' : 'default'));
		
		return $btn;
	}
	
	public function addModalButton($value, $target, $isSubmit = true)
	{
		$btn = $this->addButton($value, '', $isSubmit);
		$btn->addClass('btn-lg');
		
		return BootstrapModal::addTrigger($btn, $target);
	}
}
?>