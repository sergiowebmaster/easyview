<?php
require_once 'Component.php';

class Menu extends Component
{
    protected $tagName = 'nav';
    
    protected function addLinksRecursive(Node $parent, $data)
    {
        $list = $parent->ul();
        
        foreach($data as $label => $href)
        {
            if(is_array($href))
            {
                $this->addLinksRecursive($list->li($label), $href);
            }
            else
            {
                $list->li()->a($href, $label);
            }
        }
        
        return $list;
    }
    
    public function addLinks($data)
    {
        return $this->addLinksRecursive($this->base, $data);
    }
}
?>