<?php
class BootstrapAlert extends Component
{
	private $title;
	
	const WARNING = 'warning';
	const INFO = 'info';
	const DANGER = 'danger';
	const SUCCESS = 'success';
	
	function __construct(Node $parent, $title, $message, $type = self::WARNING)
	{
		parent::__construct($parent, 'div', 'alert alert-' . $type . ' alert-dismissible');
		
		$btn = $this->addNode('button');
		$btn->setClass('close');
		$btn->attrs(array(
				'type' => 'button',
				'data-dismiss' => 'alert',
				'aria-label' => 'Close'));
		
		$span = $btn->addNode('span');
		$span->attr('aria-hidden', 'true');
		$span->innerText('&times;');
		
		$this->title = $this->addNode('strong', $title . ':');
		$this->addTextNode($message);
	}
}
?>