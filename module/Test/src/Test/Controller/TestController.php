<?php

namespace Test\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class TestController extends AbstractActionController {
  
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
    //echo 'Hello World'; die;

    return new ViewModel();
  }

}
