<?php

namespace Test\Model;

use Zend\Db\Adapter\Adapter;
use Zend\View\Model\ViewModel;
use Zend\View\Helper;
use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Debug\Debug;
use Zend\Session\Container;

class Db {

  protected $adapter;
  public $myBasePath = 'http://www.example.com';
  
  public $configArray = array(
      "driver" => "Pdo_Mysql",
      "database" => "db",
      "username" => "root",
      "password" => "",
      "hostname" => "localhost");
  

  

}
