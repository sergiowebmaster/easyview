<?php
require_once 'Node.php';

class Page extends Node
{
	private $metaIncludes = array();
	private $head, $title, $favicon;
	
	public $body;
	
	function __construct($baseHref, $lang, $charset = 'UTF-8')
	{
		parent::__construct('html');
		self::$document->appendChild($this->node);
		
		$this->attr('lang', $lang);
		
		$this->head  = $this->addNode('head');
		$this->head->addNode('base')->attr('href', $baseHref);
		
		$this->addMeta(array('charset' => $charset));
		$this->addMetaContent('viewport', 'width=device-width, initial-scale=1');
		
		$this->favicon = $this->head->addNode('link');
		$this->title = $this->head->addNode('title');
		$this->body = $this->addNode('body');
	}
	
	public function setFavicon($href, $type = 'image/png')
	{
		$this->favicon->attrs(array('rel' => 'shortcut icon', 'type' => $type, 'href' => $href));
	}
	
	public function setTitle($title)
	{
		$this->title->innerText($title);
	}
	
	public function addMeta($data)
	{
		$this->head->addNode('meta')->attrs($data);
	}
	
	public function addMetaContent($name, $content)
	{
		$this->addMeta(array('name' => $name, 'content' => $content));
	}
	
	public function addMetaOG($og)
	{
		foreach ($og as $property => $content)
		{
			$this->addMeta(array(
					'property' => 'og:' . $property,
					'content' => $content)
			);
		}
	}
	
	public function setDescription($description)
	{
		$this->addMetaContent('description', $description);
	}
	
	public function setKeywords($keywords)
	{
		$this->addMetaContent('keywords', $keywords);
	}
	
	public function setAuthor($author)
	{
		$this->addMetaContent('author', $author);
	}
	
	public function refresh($seconds)
	{
		if($seconds) $this->addMeta(array('http-equiv' => 'refresh', 'content' => $seconds));
	}
	
	public function addCSS($href, $attr = array())
	{
		$tag = $this->head->addNode('link');
		$tag->attr('rel', 'stylesheet');
		$tag->attr('href', $href);
		$tag->attrs($attr);
	}
	
	public function addJS($src, $attr = array())
	{
		$tag = $this->addJsCode('');
		$tag->attr('src', $src);
		$tag->attrs($attr);
	}
	
	public function addJsCode($code)
	{
		return $this->head->addJsCode($code);
	}
	
	public function addJsDefer($src)
	{
		$this->addJS($src, array('defer' => 'defer'));
	}
	
	function __destruct()
	{
		$this->render();
	}
}
?>