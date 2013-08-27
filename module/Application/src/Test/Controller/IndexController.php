<?php

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController {
  
  private $title = "";
  private $keyword = "";
  private $description = "";
  private $raw = null;
  private $data = null;
  private $get = null;

  public function __construct(){
    //you can now access the router used by the MVC application 
  }
  
  public function indexAction() {
    
    $r = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
    $r->headTitle($this->title);
    $r->headMeta()->appendName('keywords', $this->keyword)->setIndent(8);
    $r->headMeta()->appendName('description', $this->description)->setIndent(8);
    $r->headMeta()->appendName('Language', 'en')->setIndent(8);
    $r->headMeta()->appendName('dc.title', $this->title)->setIndent(8);
    $r->headMeta()->appendName('dc.keywords', $this->keyword)->setIndent(8);
    $r->headMeta()->appendName('dc.description', $this->description)->setIndent(8);
    
    return new ViewModel();
    
  }

}
