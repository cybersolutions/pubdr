<?php
namespace Test;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http;

class Module {

  public function onBootstrap(MvcEvent $e) { 
    
    $e->getApplication()->getServiceManager()->get('translator');
    $eventManager = $e->getApplication()->getEventManager();
    $moduleRouteListener = new ModuleRouteListener();
    $moduleRouteListener->attach($eventManager);
    $router = $e->getApplication()->getServiceManager()->get('router');
  }
  
  public function getConfig() {
    return include __DIR__ . '/config/module.config.php';
  }

  public function getAutoloaderConfig() {
    return array(
      'Zend\Loader\StandardAutoloader' => array(
        'namespaces' => array(
          __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
        ),
      ),
    );
  }
  
  
  public function getServiceConfig()
    {
        return array(
          'initializers' => array(

              function ($instance, $sm) {

                  if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
                        $instance->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                  }
              }
            ),
            'factories' => array(
                'Test\Model\GlobalAccess' =>  function($sm){
                  $table     = new Model\GlobalAccess();
                  return $table;
                },
            ),

        );
    }

}
