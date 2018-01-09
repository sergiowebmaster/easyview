<?php
class FacebookPlugin extends Component
{
	protected function getUrl($uri)
	{
		return 'https://www.facebook.com/' . $uri . '/';
	}
	
	protected function setHref($url)
	{
		$this->attr('data-href', $url);
	}
}
?>