<?php
require_once 'Component.php';

class Form extends Component
{
	public $fieldset;
	
	const ACCEPT_IMAGE = 'image/*';
	const ACCEPT_PDF = 'application/pdf';
	const ACCEPT_DOC = '.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document';
	const ACCEPT_EXCEL = 'application/vnd.ms-excel';
	const ACCEPT_PPT = 'application/vnd.ms-powerpoint';
	
	function __construct(Node $parent, $action, $method = 'post')
	{
		parent::__construct($parent, 'form', '');
		
		$this->attr('action', $action);
		$this->attr('method', $method);
		
		$this->fieldset = $this;
	}
	
	public function addFieldset($legend)
	{
		$this->fieldset = $this->addNode('fieldset');
		$this->fieldset->addNode('legend', $legend);
	}
	
	protected function createLabel(Node $parent, $text, $for)
	{
		$label = $parent->addNode('label', $text);
		$label->attr('for', $for);
		
		return $label;
	}
	
	public function addLabel($text, $for)
	{
		return $this->createLabel($this->fieldset, $text, $for);
	}
	
	protected function formatInput(Node $input, $name, $placeholder)
	{
		$input->attr('name', $name);
		$input->attr('placeholder', $placeholder);
	}
	
	protected function createInput(Node $parent, $type, $name, $placeholder, $value, $size, $maxlength)
	{
		$input = $parent->addNode('input');
		$input->attrs(array(
				'type' => $type,
				'value' => $value,
				'size' => $size,
				'maxlength' => $maxlength
		));
		
		$this->formatInput($input, $name, $placeholder);
		
		return $input;
	}
	
	protected function createInputFile(Node $parent, $name, $size, $accept, $multiple)
	{
		$this->attr('enctype', 'multipart/form-data');
		
		$input = $this->createInput($parent, 'file', $name, '', '', $size, 0);
		
		if($accept) $input->attr('accept', $accept);
		if($multiple) $input->attr('multiple', 'multiple');
		
		return $input;
	}
	
	protected function createSelect(Node $parent, $name, $options, $value)
	{
		$node = $parent->addNode('select');
		
		foreach ($options as $optValue => $label)
		{
			$option = $node->addNode('option', $label);
			$option->attr('value', $optValue);
				
			if($optValue == $value) $option->selected();
		}
		
		$this->formatInput($node, $name, '');
		
		return $node;
	}
	
	protected function createTextarea(Node $parent, $name, $rows, $cols, $placeholder, $value)
	{
		$textarea = $parent->addNode('textarea', $value);
		$textarea->attrs(array(
				'rows' => $rows,
				'cols' => $cols
		));
		
		$this->formatInput($textarea, $name, $placeholder);
		
		return $textarea;
	}
	
	protected function createChooseInput(Node $parent, $type, $name, $value, $label, $checked = false)
	{
		$input = $this->createInput($parent, $type, $name, '', $value, 0, 0);
		$input->setId($name);
		
		if($checked) $input->checked();
		
		$parent->addTextNode($label);
		
		return $input;
	}
	
	public function input($type, $name, $placeholder, $value, $size, $maxlength)
	{
		return $this->createInput($this->fieldset, $type, $name, $placeholder, $value, $size, $maxlength);
	}
	
	public function inputText($name, $size, $maxlength, $placeholder = '', $value = '')
	{
		return $this->input('text', $name, $placeholder, $value, $size, $maxlength);
	}
	
	public function inputPwd($name, $placeholder, $value = '', $size = 8, $maxlength = 10)
	{
		return $this->input('password', $name, $placeholder, $value, $size, $maxlength);
	}
	
	public function inputFile($name, $size, $accept = '', $multiple = false)
	{
		return $this->createInputFile($this->fieldset, $name, $size, $accept, $multiple);
	}
	
	public function checkbox($name, $value, $label, $checked = false)
	{
		return $this->createChooseInput($this->fieldset, 'checkbox', $name, $value, $label, $checked);
	}
	
	public function radio($name, $value, $label, $checked = false)
	{
		return $this->createChooseInput($this->fieldset, 'radio', $name, $value, $label, $checked);
	}
	
	public function select($name, $options, $value = '')
	{
		return $this->createSelect($this->fieldset, $name, $options, $value);
	}
	
	public function textarea($name, $rows = 5, $cols = 50, $placeholder = '', $value = '')
	{
		return $this->createTextarea($this->fieldset, $name, $rows, $cols, $placeholder, $value);
	}
	
	public function addButton($value, $name = '')
	{
		$btn = $this->input('button', $name, '', $value, '', '');
		
		if ($name) $btn->attr('type', 'submit');
		
		return $btn;
	}
}
?>