<?php

class Blog_IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        
        $auth = Zend_Auth::getInstance();
        var_dump($auth->getStorage()->read());
        die();
        
        /* instancia o modulo */
        $blog = new Blog_Model_Blog;
        
        /* instancia o form */
        $form = new Blog_Form_Blog();
                
        /* envia p/ view os dados da função info */
        $blog->view->info = $blog->info();
        
        
        
        $this->view->form = $form;
    }

}

?>