<?php
require_once 'Node.php';
require_once 'Menu.php';

class Page
{
	private $html, $head, $title, $favicon;
	
	public $body, $header, $nav, $content, $aside, $footer;
	
	function __construct()
	{
	    $this->html = new Node('html');
	    $this->head = $this->html->addNode('head');
	    $this->body = $this->html->addNode('body');
	    $this->title = $this->head->addNode('title');
	}

	public function createBasicStructure()
	{
	    $this->header = $this->body->addNode('header');
	    $this->nav = new Menu($this->body);
	    $this->content = $this->body->addNode('article');
	    $this->aside = $this->body->addNode('aside');
	    $this->footer = $this->body->addNode('footer');
	}
	
	public function addH1Title()
	{
	    $this->content->h1($this->getTitle());
	}
	
	public function setLang($language)
	{
	    $this->html->attr('lang', $language);
	}
	
	public function addBaseHref($url)
	{
	    $this->head->addNode('base')->attr('href', $url);
	}
	
	public function getTitle()
	{
	    return $this->title->getValue();
	}
	
	public function setTitle($title)
	{
	    $this->title->setValue($title);
	}
	
	protected function addMetaTag()
	{
	    return $this->head->addNode('meta');
	}
	
	public function addMetaContent($name, $content)
	{
	    $this->addMetaTag()->attrs(array('name' => $name, 'content' => $content));
	}
	
	public function addMetaOG($property, $content)
	{
	    $this->addMetaTag()->attrs(array('property' => "og:$property", 'content' => $content));
	}
	
	public function addCharset($charset)
	{
	    $this->addMetaTag()->attr('charset', $charset);
	}
	
	public function addRobots($robots)
	{
	    $this->addMetaContent('robots', $robots);
	}
	
	public function addDescription($description)
	{
	    $this->addMetaContent('description', $description);
	}
	
	public function addKeywords($keywords)
	{
	    $this->addMetaContent('keywords', $keywords);
	}
	
	public function addAuthor($author)
	{
	    $this->addMetaContent('author', $author);
	}
	
	public function refresh($seconds)
	{
	    if($seconds) $this->addMetaTag()->attrs(array('http-equiv' => 'refresh', 'content' => $seconds));
	}
	
	public function addLinkTag($data)
	{
	    $this->head->addNode('link')->attrs($data);
	}
	
	public function addCSS($href, $aditionalAttributes = array())
	{
	    $this->addLinkTag(array_merge(array('rel' => 'stylesheet', 'href' => $href), $aditionalAttributes));
	}
	
	public function addScriptTag($data, $code = '')
	{
	    $this->head->addNode('script', $code)->attrs($data);
	}
	
	public function addJS($src, $code = '', $aditionalAttributes = array())
	{
	    $this->addScriptTag(array_merge(array('type' => 'text/javascript', 'src' => $src), $aditionalAttributes), $code);
	}
	
	public function addJsDefer($src)
	{
	    $this->addJS($src, '', array('defer' => 'defer'));
	}
	
	public function addJavascriptCode($code)
	{
	    $this->addJS('', $code);
	}
	
	public function addLoginForm(Node $parent, $actionUri, $title, $emailLabel, $passwordLabel, $submitLabel = 'Login')
	{
	    require_once 'Form.php';
	    
	    $form = new Form($parent);
	    $form->setAction($actionUri);
	    $form->addFieldset($title);
	    $form->addTextField($emailLabel, 'email', 20, 100);
	    $form->addPasswordField($passwordLabel, 'password');
	    $form->addInputSubmit('action', $submitLabel);
	    
	    return $form;
	}
	
	public function addContactForm($actionUri, $title, $nameLabel, $emailLabel, $subjectLabel, $messageLabel, $submitLabel = 'Send')
	{
	    require_once 'Form.php';
	    
	    $form = new Form($this->content);
	    $form->setAction($actionUri);
	    $form->addFieldset($title);
	    $form->addTextField($nameLabel, 'name', 50, 40);
	    $form->addTextField($emailLabel, 'email', 50, 100);
	    $form->addTextField($subjectLabel, 'subject', 50, 100);
	    $form->addTextareaField($messageLabel, 'message');
	    $form->addInputSubmit('action', $submitLabel);
	    
	    return $form;
	}
	
	public function addTable($caption, $columnNames, $rowsData, $footerData = array())
	{
	    require_once 'Table.php';
	    
	    $table = new Table($this->content);
	    $table->addCaption($caption);
	    $table->addTHeadData($columnNames);
	    $table->addTBodyData($rowsData);
	    
	    if($footerData) $table->addTFootData($footerData);
	    
	    return $table;
	}
}
?>