<?php
class BootstrapCarousel extends Component
{
	private $id = '';
	private $indicators, $wrapper;
	private $n = 0;
	
	public $index = 0;
	
	function __construct(Node $parent, $id)
	{
		parent::__construct($parent, 'div', 'carousel slide');
		
		$this->id = $id;
		
		$this->setId($id);
		$this->attr('data-ride', 'carousel');
		
		$this->indicators = $this->addNode('ol');
		$this->indicators->setClass('carousel-indicators');
		
		$this->wrapper = $this->addNode('div');
		$this->wrapper->attrs(array('class' => 'carousel-inner', 'role' => 'listbox'));
		
		$this->addControls();
	}
	
	public function addBanner($src, $alt)
	{
		$li = $this->indicators->addNode('li');
		$li->attrs(array(
				'data-target' => '#' . $this->id,
				'data-slide-to' => $this->n)
		);
		
		$div = $this->wrapper->addNode('div');
		$div->setClass('item');
		$div->img($alt, $src);
		
		if($this->index == $this->n++)
		{
			$li->setClass('active');
			$div->addClass('active');
		}
	}
	
	public function addBanners($path, $array)
	{
		foreach ($array as $src => $alt)
		{
			$this->addBanner($path . $src, $alt);
		}
	}
	
	private function createArrow($dataSlide, $label, $direction)
	{
		$a = $this->addNode('a');
		$a->attrs(array('class' => $direction . ' carousel-control', 'href' => '#' . $this->id, 'role' => 'button', 'data-slide' => $dataSlide));
		
		$a->addNode('span')->attrs(array('class' => 'glyphicon glyphicon-chevron-' . $direction, 'aria-hidden' => 'true'));
		$a->addNode('span', $label)->setClass('sr-only');
	}
	
	public function createGeneric()
	{
		$this->addBanner('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzkwMHg1MDAvYXV0by8jNzc3OiM1NTUvdGV4dDpGaXJzdCBzbGlkZQpDcmVhdGVkIHdpdGggSG9sZGVyLmpzIDIuNi4wLgpMZWFybiBtb3JlIGF0IGh0dHA6Ly9ob2xkZXJqcy5jb20KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28KLS0+PGRlZnM+PHN0eWxlIHR5cGU9InRleHQvY3NzIj48IVtDREFUQVsjaG9sZGVyXzE1NWM1M2MwYjBlIHRleHQgeyBmaWxsOiM1NTU7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6NDVwdCB9IF1dPjwvc3R5bGU+PC9kZWZzPjxnIGlkPSJob2xkZXJfMTU1YzUzYzBiMGUiPjxyZWN0IHdpZHRoPSI5MDAiIGhlaWdodD0iNTAwIiBmaWxsPSIjNzc3Ii8+PGc+PHRleHQgeD0iMzA4IiB5PSIyNzAuNCI+Rmlyc3Qgc2xpZGU8L3RleHQ+PC9nPjwvZz48L3N2Zz4=', 'First Slide');
		$this->addBanner('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzkwMHg1MDAvYXV0by8jNjY2OiM0NDQvdGV4dDpTZWNvbmQgc2xpZGUKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTVjNTNiYWYxNSB0ZXh0IHsgZmlsbDojNDQ0O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjQ1cHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NWM1M2JhZjE1Ij48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzY2NiIvPjxnPjx0ZXh0IHg9IjI2NC41IiB5PSIyNzAuNCI+U2Vjb25kIHNsaWRlPC90ZXh0PjwvZz48L2c+PC9zdmc+', 'Second Slide');
		$this->addControls();
	}
	
	private function addControls()
	{
		$this->createArrow('prev', 'Previous', 'left');
		$this->createArrow('next', 'Next', 'right');
	}
}
?>