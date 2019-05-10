<?php
class Node
{
    public $node;
    
    protected static $document;
    
    public static function createDocument()
    {
        self::$document = new DOMDocument();
        self::$document->formatOutput = true;
    }
    
    public static function renderDocument()
    {
        echo self::$document->saveHTML();
    }
    
	function __construct($name, $value = '')
	{
	    $this->init($name, $value);
	}
	
	protected function init($name, $value)
	{
	    $this->checkDocument();
	    $this->create($name, $value);
	    $this->addToDocument();
	}
	
	private function checkDocument()
	{
	    if (!self::$document) self::createDocument();
	}
	
	private function create($name, $value)
	{
	    $this->node = self::$document->createElement($name, $value);
	}
	
	private function addToDocument()
	{
	    self::$document->appendChild($this->node);
	}
	
	private function addChild($childNode)
	{
	    $this->node->appendChild($childNode);
	}
	
	public function text($value)
	{
	    return $this->addChild(new DOMText("$value\n"));
	}
	
	public function breakLine()
	{
	    $this->text('');
	}
	
	public function add(Node $newNode)
	{
	    $this->addChild($newNode->node);
	    $this->breakLine();
	    
	    return $newNode;
	}
	
	public function addNode($name, $value = '')
	{
	    return $this->add(new Node($name, $value));
	}
	
	public function setValue($value)
	{
	    $this->node->nodeValue = $value;
	}
	
	public function attr($name, $value)
	{
	    if(strlen($value))
	    {
	        $this->node->setAttribute($name, $value);
	    }
	}
	
	public function attrs($data)
	{
	    foreach ($data as $attr => $value)
	    {
	        $this->attr($attr, $value);
	    }
	}
	
	public function getAttribute($name)
	{
	    return $this->node->getAttribute($name);
	}
	
	public function setId($id)
	{
	    $this->attr('id', $id);
	}
	
	public function setClass($cssClasses)
	{
	    $this->attr('class', $cssClasses);
	}
	
	public function addClass($cssClasses)
	{
	    $this->setClass(join(' ', array($this->getAttribute('class'), $cssClasses)));
	}
	
	public function setStyle($cssParams)
	{
	    $this->attr('style', $cssParams);
	}
	
	public function setIdentifiers($id, $cssClasses)
	{
	    $this->setId($id);
	    $this->setClass($cssClasses);
	}
	
	public function checked()
	{
	    $this->attr('checked', 'checked');
	}
	
	public function selected()
	{
	    $this->attr('selected', 'selected');
	}
	
	public function disabled()
	{
	    $this->attr('disabled', 'disabled');
	}
	
	public function br($qty = 1)
	{
	    for($i = 0; $i < $qty; $i++)
	    {
	        $this->addNode('br');
	    }
	}
	
	public function onClick($jsCode)
	{
	    $this->attr('onclick', $jsCode);
	}
	
	public function onChange($jsCode)
	{
	    $this->attr('onchange', $jsCode);
	}
	
	public function h1($text)
	{
	    return $this->addNode('h1', $text);
	}
	
	public function h2($text)
	{
	    return $this->addNode('h2', $text);
	}
	
	public function h3($text)
	{
	    return $this->addNode('h3', $text);
	}
	
	public function h4($text)
	{
	    return $this->addNode('h4', $text);
	}
	
	public function h5($text)
	{
	    return $this->addNode('h5', $text);
	}
	
	public function h6($text)
	{
	    return $this->addNode('h6', $text);
	}
	
	public function p($text)
	{
	    return $this->addNode('p', $text);
	}
	
	public function strong($text)
	{
	    return $this->addNode('strong', $text);
	}
	
	public function a($href, $text, $target = '')
	{
	    $a = $this->addNode('a', $text);
	    $a->attr('href', $href);
	    
	    if($target) $a->attr('target', $target);
	    
	    return $a;
	}
	
	public function img($alt, $src)
	{
	    $img = $this->addNode('img');
	    $img->attrs(array('alt' => $alt, 'src' => $src));
	    
	    return $img;
	}
	
	public function div($value = '')
	{
	    return $this->addNode('div', $value);
	}
	
	public function ul()
	{
	    return $this->addNode('ul');
	}
	
	public function ol()
	{
	    return $this->addNode('ol');
	}
	
	public function li($value = '')
	{
	    return $this->addNode('li', $value);
	}
	
	public function table()
	{
	    return $this->addNode('table');
	}
	
	public function tHead()
	{
	    return $this->addNode('thead');
	}
	
	public function tBody()
	{
	    return $this->addNode('tbody');
	}
	
	public function tFoot()
	{
	    return $this->addNode('tfoot');
	}
	
	public function tr()
	{
	    return $this->addNode('tr');
	}
	
	public function td($text = '')
	{
	    return $this->addNode('td', $text);
	}
	
	public function th($text = '')
	{
	    return $this->addNode('th', $text);
	}
	
	function __destruct()
	{
	    if($this->node->parentNode === self::$document) self::renderDocument();
	}
}
?>