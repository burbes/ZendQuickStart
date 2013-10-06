<?php

class Default_LoginController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
        $form = new Default_Form_Login;

        $request = $this->_request;

        if ($request->isPost()) {
            $data = $request->getPost();
            
            if ($form->isValid($data)) {
                $data = $form->getValues();
                $login = Default_Model_Login::login($data['login'], $data['senha']);
                var_dump($login);

                if ($login == true) {
                    $this->_redirect('/blog');
                } else {
                    /* 1 forma */
                    //$flash = $this->_helper->getHelper('FlashMessenger');   
                    //$flash = $this->_helper->FlashMessenger(array('erro'=>$login));
                    //$this->view->messages = $flash->getMessages();
                    
                    /* 2 forma */
                    $flash = $this->_helper->FlashMessenger(array('erro'=>$login));
                }
            }
        }

        $this->view->form = $form;
    }

}

