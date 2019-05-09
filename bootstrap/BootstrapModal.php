<?php
class BootstrapModal extends Component
{
	const LARGE = 'lg';
	const SMALL = 'sm';
	
	public $body, $footer;
	
	function __construct($parent, $title, $text, $size = self::SMALL)
	{
		parent::__construct($parent, 'div', 'modal fade bs-example-modal-' . $size);
		
		$label = 'myModalLabel';
		
		$this->attrs(array('tabindex' => '-1', 'role' => 'dialog', 'aria-labelledby' => $label));
		
		$dialog = $this->addNode('div');
		$dialog->setClass('modal-dialog modal-' . $size);
		
		$content = $dialog->addNode('div');
		$content->setClass('modal-content');
		
		$header = $content->addNode('div');
		$header->setClass('modal-header');
		$header->h4($title)->attrs(array('class' => 'modal-title', 'id' => $label));
		
		$this->body = $content->addNode('div');
		$this->body->setClass('modal-body');
		$this->body->innerText($text);
		
		$this->footer = new BootstrapForm($content, '');
		$this->footer->setClass('modal-footer');
	}
	
	public function addCloseButton($label)
	{
		$btn = $this->footer->addButton($label);
		$btn->attr('data-dismiss', 'modal');
		
		return $btn;
	}
	
	public function addPrimaryButton($label)
	{
		return $this->footer->addButton($label, '', true);
	}
	
	public static function addTrigger(Node $trigger, $target)
	{
		$trigger->attrs(array('data-toggle' => 'modal', 'data-target' => $target));
	}
}
?>