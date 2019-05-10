<?php
require_once 'Node.php';

class Page
{
	private $html, $head, $title, $favicon;
	
	public $body;
	
	function __construct()
	{
	    $this->html = new Node('html');
	    $this->head = $this->html->addNode('head');
	    $this->body = $this->html->addNode('body');
	    $this->title = $this->head->addNode('title');
	}
	
	public function addBaseHref($url)
	{
	    $this->head->addNode('base')->attr('href', $url);
	}
	
	public function setTitle($title)
	{
	    $this->title->setValue($title);
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
	
	public function addJsScript($code)
	{
	    $tag = $this->head->addNode('script');
	    $tag->attr('type', 'text/javascript');
	    $tag->setValue($code);
	    
	    return $tag;
	}
	
	public function addJS($src, $attr = array())
	{
	    $tag = $this->addJsScript('');
	    $tag->attr('src', $src);
	    $tag->attrs($attr);
	}
	
	public function addJsDefer($src)
	{
	    $this->addJS($src, array('defer' => 'defer'));
	}
}
?>