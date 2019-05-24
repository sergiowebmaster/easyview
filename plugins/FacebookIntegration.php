<?php
class FacebookIntegration
{
	function __construct(Page $page)
	{
		$page->body->addNode('div')->setId('fb-root');
		$page->addJavascriptCode('(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, \'script\', \'facebook-jssdk\'));');
	}
	
	public function addPage(Node $parent, $uri, $name)
	{
		return new FacebookPagePlugin($parent, $uri, $name);
	}
	
	public function addShareButton(Node $parent, $url)
	{
		return new FacebookShareButton($parent, $url);
	}
	
	public function addFollowButton(Node $parent, $profileUri)
	{
		return new FacebookFollowButton($parent, $profileUri);
	}
	
	public function addLikeButton(Node $parent, $url)
	{
		return new FacebookLikeButton($parent, $url);
	}
}