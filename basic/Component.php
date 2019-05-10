<?php
require_once 'Node.php';

class Component
{
    protected $tagName = 'div';
    
    public $base;
    
    function __construct(Node $parent)
    {
        $this->createBase($parent);
        $this->configureBase();
        $this->createStructure();
    }
    
    protected function setClassByComponent()
    {
        $this->base->setClass(get_called_class());
    }
    
    protected function createBase(Node $parent)
    {
        $this->base = $parent->addNode($this->tagName);
    }
    
    protected function configureBase()
    {
        // Do implement.
    }
    
    protected function createStructure()
    {
        // Do implement.
    }
    
    public function setID($id)
    {
        $this->base->setId($id);
    }
    
    public function setClass($cssClasses)
    {
        $this->base->setClass($cssClasses);
    }
}
?>