<?php
class Node
{
	protected static $document;
	
	protected $node;
	
	public $parent;
	
	function __construct($name, $value = '')
	{
		$this->checkDocument();
		$this->node = self::$document->createElement($name, $value);
	}
	
	public static function createDocument()
	{
		self::$document = new DOMDocument();
		self::$document->preserveWhiteSpace = true;
		self::$document->formatOutput = true;
	}
	
	private function checkDocument()
	{
		if(!self::$document) self::createDocument();
	}
	
	public function render()
	{
		echo self::$document->saveHTML();
	}
	
	public function setParent(Node $parent)
	{
		$this->parent = $parent;
	}
	
	public function add(Node $node)
	{
		$node->setParent($this);
		$this->node->appendChild($node->node);
		return $node;
	}
	
	public function innerText($text)
	{
		$this->node->nodeValue = $text;
	}
	
	public function addValue($text)
	{
		$this->node->nodeValue .= $text;
	}
	
	public function innerHTML($code)
	{
		if($code)
		{
			$html = self::$document->createDocumentFragment();
			$html->appendXML(html_entity_decode($code));
			
			$this->node->appendChild($html);
		}
	}
	
	public function addNode($name, $value = '')
	{
		return $this->add(new Node($name, $value));
	}
	
	public function addConditionalNode($name, $value)
	{
		return $value? $this->addNode($name, $value) : new Node($name);
	}
	
	public function addList($data, $baseHref = '')
	{
		$ul = $this->addNode('ul');
		
		foreach ($data as $index => $text)
		{
			$li = $ul->addNode('li');
			
			if($baseHref || is_string($index))
			{
				$a = $li->addNode('a', $text);
				$a->attr('href', $baseHref . $index);
			}
			else
			{
				$li->innerText($text);
			}
		}
		
		return $ul;
	}
	
	public function addLinks($array)
	{
		foreach ($array as $label => $href)
		{
			$this->a($href, $label);
		}
	}
	
	public function addText($plainText)
	{
		$text = str_replace("\r\n", '<br />', $plainText);
		
		foreach (explode('<br /><br />', $text) as $paragraph)
		{
			$this->p('')->innerHTML($paragraph);
		}
	}
	
	public function addTextNode($text)
	{
		if($text)
		{
			$textNode = self::$document->createTextNode("\n".$text."\n");
			$this->node->appendChild($textNode);
		}
	}
	
	public function attr($name, $value)
	{
		if($value || is_numeric($value))
		{
			$this->node->setAttribute($name, $value);
		}
	}
	
	public function attrBool($name, $boolean)
	{
		$this->attr($name, $boolean? 'true' : 'false');
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
	
	public function setClass($cssClassName)
	{
		$this->attr('class', $cssClassName);
	}
	
	public function addClass($cssClassName)
	{
		$this->attr('class', $this->node->getAttribute('class') . ' ' . $cssClassName);
	}
	
	public function setStyle($cssParams)
	{
		$this->attr('style', $cssParams);
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
	
	public function addJsCode($code)
	{
		$tag = $this->addNode('script');
		$tag->attr('type', 'text/javascript');
		$tag->addTextNode($code);
		
		return $tag;
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
	
	public function ul($list, $baseUri = '')
	{
		$ul = $this->addNode('ul');
		
		foreach ($list as $index => $data)
		{
			$href = $baseUri . $index;
			
			if(is_numeric($href))
			{
				$ul->addNode('li', $data);
			}
			else
			{
				$ul->addNode('li')->a($href, $data);
			}
		}
		
		return $ul;
	}
	
	public function icon($href, $alt, $src)
	{
		return $this->a($href, '')->img($alt, $src);
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
}
?>