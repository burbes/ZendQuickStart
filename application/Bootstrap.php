<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initDoctype() {

//echo $this->hasPluginResource('view');
//$this->bootstrap('view');
//$view = $this->getResource('view');

        $view = $this->bootstrap('view')->getResource('view');

//DOCTYPE
        $view->Doctype('XHTML1_TRANSITIONAL');

//TITLE
        $view->headTitle('Projeto Zend FrameWork')->setSeparator(' | ');

//CSS
        $view->headLink()->prependStylesheet('/css/style.css');

//JS
        $view->headScript()->prependFile('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
    }

    /*
      protected function _initDatabases() {
      $this->bootstrap('multidb'); // line 41
      $resource = $this->getPluginResource('multidb');
      $databases = Zend_Registry::get('config')->resources->multidb;
      foreach ($databases as $name => $adapter) {
      $db_adapter = $resource->getDb($name);
      Zend_Registry::set($name, $db_adapter);
      }
      } */
    
//Adicione no Bootstrap.php - copiei do site mas não 'funciona'
//$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
//$viewRenderer->initView();
//$viewRenderer->view->addBasePath(APPLICATION_PATH . '/layouts/');
}


