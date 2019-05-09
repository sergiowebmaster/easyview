<?php
class GoogleMap extends Component
{
	function __construct(Node $parent, $address, $country)
	{
		parent::__construct($parent, 'iframe', 'googlemap');
		
		$this->attrs(array('frameborder' => 0, 'allowfullscreen' => 'true'));
		$this->setByCode($address, $country);
	}
	
	public function setByCode($address, $country)
	{
		$this->attr('src', 'https://www.google.com.br/maps?q='.$address.',%20'.$country.'&output=embed');
	}
}
?>