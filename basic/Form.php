<?php
require_once 'Component.php';

class Form extends Component
{
    protected $tagName = 'form';
    protected $fieldset, $field;
	
	const ACCEPT_IMAGE = 'image/*';
	const ACCEPT_PDF = 'application/pdf';
	const ACCEPT_DOC = '.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document';
	const ACCEPT_EXCEL = 'application/vnd.ms-excel';
	const ACCEPT_PPT = 'application/vnd.ms-powerpoint';
	
	protected function configureBase()
	{
	    $this->setMethod('post');
	}
	
	protected function getParent()
	{
	    if($this->field) return $this->field;
	    else if($this->fieldset) return $this->fieldset;
	    else return $this->base;
	}
	
	protected function setName($name, Node $tag)
	{
	    $tag->attr('name', $name);
	}
	
	protected function setPlaceholder($placeholder, Node $tag)
	{
	    $tag->attr('placeholder', $placeholder);
	}
	
	public function setAction($action)
	{
	    $this->base->attr('action', $action);
	}
	
	public function setMethod($method)
	{
	    $this->base->attr('method', $method);
	}
	
	protected function setEnctype($enctype)
	{
	    $this->base->attr('enctype', $enctype);
	}
	
	protected function setEnctypeUpload()
	{
	    $this->setEnctype('multipart/form-data');
	}
	
	public function addFieldset($legend)
	{
		$this->fieldset = $this->base->addNode('fieldset');
		$this->fieldset->addNode('legend', $legend);
	}
	
	protected function createLabel($text, $for)
	{
		$label = $this->getParent()->addNode('label', $text);
		$label->attr('for', $for);
		
		return $label;
	}
	
	public function addField($label, $for)
	{
	    if($this->fieldset)
	    {
    		$this->field = $this->fieldset->div();
    		$this->field->setClass('field-group');
    		$this->createLabel($label, $for);
	    }
	    else
	    {
	        echo 'The fieldset is not founded!';
	    }
	}
	
	protected function createInput(Node $parent, $type, $id, $name, $placeholder, $value, $size, $maxlength)
	{
	    $input = $parent->addNode('input');
	    $input->setId($id);
		$input->attrs(array(
			'type' => $type,
			'value' => $value,
			'size' => $size,
			'maxlength' => $maxlength
		));
		
		$this->setName($name, $input);
		$this->setPlaceholder($placeholder, $input);
		
		return $input;
	}
	
	protected function createInputFile($name, $size, $maxlength, $accept, $multiple)
	{
		$this->setEnctypeUpload();
		
		$input = $this->createInput($this->getParent(), 'file', $name, $name, '', '', $size, $maxlength);
		
		if($accept) $input->attr('accept', $accept);
		if($multiple) $input->attr('multiple', 'multiple');
		
		return $input;
	}
	
	protected function createSelect($name, $options, $value)
	{
	    $select = $this->getParent()->addNode('select');
	    $select->setId($name);
	    
	    $this->setName($name, $select);
		
		foreach ($options as $optValue => $label)
		{
			$option = $select->addNode('option', $label);
			$option->attr('value', $optValue);
				
			if($optValue == $value) $option->selected();
		}
		
		return $select;
	}
	
	protected function createTextarea($name, $placeholder, $value, $rows, $cols)
	{
		$textarea = $this->getParent()->addNode('textarea', $value);
		$textarea->setId($name);
		$textarea->attrs(array(
			'rows' => $rows,
			'cols' => $cols
		));
		
		$this->setName($name, $textarea);
		$this->setPlaceholder($placeholder, $textarea);
		
		return $textarea;
	}
	
	protected function createChooseInput($type, $name, $value, $label, $checked)
	{
		$input = $this->createInput($this->getParent(), $type, '', $name, '', $value, '', '');
		
		if($checked) $input->checked();
		
		$this->getParent()->text($label);
		
		return $input;
	}
	
	protected function createInputButton($value, $name = '')
	{
	    return $this->createInput($this->fieldset, $name? 'submit' : 'button', '', $name, '', $value, '', '');
	}
	
	public function addInputText($name, $size, $maxlength, $placeholder = '', $value = '')
	{
	    return $this->createInput($this->getParent(), 'text', $name, $name, $placeholder, $value, $size, $maxlength);
	}
	
	public function addInputPwd($name, $placeholder, $value = '', $size = 8, $maxlength = 10)
	{
	    return $this->createInput($this->getParent(), 'password', $name, $name, $placeholder, $value, $size, $maxlength);
	}
	
	public function addInputFile($name, $size, $accept = '', $multiple = false, $maxlength = 100)
	{
	    return $this->createInputFile($name, $size, $maxlength, $accept, $multiple);
	}
	
	public function addInputSubmit($name, $value)
	{
	    return $this->createInput($this->getParent(), 'submit', '', $name, '', $value, '', '');
	}
	
	public function addCheckbox($name, $value, $label, $checked = false)
	{
		return $this->createChooseInput('checkbox', $name, $value, $label, $checked);
	}
	
	public function addCheckboxGroup($name, $data, $defaultValues = array())
	{
	    foreach ($data as $value => $label)
	    {
	        $this->addCheckbox($name, $value, $label, is_array($defaultValues) && in_array($value, $defaultValues));
	    }
	}
	
	public function addRadio($name, $value, $label, $checked = false)
	{
	    return $this->createChooseInput('radio', $name, $value, $label, $checked);
	}
	
	public function addRadioGroup($name, $data, $defaultValue = '')
	{
	    foreach ($data as $value => $label)
	    {
	        $this->addRadio($name, $value, $label, $value === $defaultValue);
	    }
	}
	
	public function addSelect($name, $options, $value = '')
	{
	    return $this->createSelect($name, $options, $value);
	}
	
	public function addTextarea($name, $placeholder = '', $value = '', $rows = 5, $cols = 50)
	{
	    return $this->createTextarea($name, $placeholder, $value, $rows, $cols);
	}
	
	public function addInputButton($value, $name = '')
	{
		return $this->createInputButton($value, $name);
	}
	
	public function addTextField($label, $name, $size, $maxlength)
	{
	    $this->addField($label, $name);
	    $this->addInputText($name, $size, $maxlength)->setId($name);
	}
	
	public function addPasswordField($label, $name, $placeholder = '******', $size = 8, $maxlength = 10)
	{
	    $this->addField($label, $name);
	    $this->addInputPwd($name, $placeholder, '', $size, $maxlength)->setId($name);
	}
	
	public function addSelectField($label, $name, $options, $value = '')
	{
	    $this->addField($label, $name);
	    $this->addSelect($name, $options, $value)->setId($name);
	}
	
	public function addTextareaField($label, $name, $rows = 10, $cols = 50)
	{
	    $this->addField($label, $name);
	    $this->addTextarea($name, '', '', $rows, $cols)->setId($name);
	}
}
?>