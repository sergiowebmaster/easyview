<?php
require_once 'FacebookPlugin.php';

class FacebookShareButton extends FacebookButton
{
	function __construct(Node $parent, $url)
	{
		parent::__construct($parent, 'fb-share-button', $url);
		$this->useMobileIframe(false);
	}
	
	public function useMobileIframe($boolean = true)
	{
		$this->attrBool('data-mobile_iframe', $boolean);
	}
}
?>