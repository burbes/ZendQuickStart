<?php

class LoginController extends Zend_Controller_Action {

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

                if ($login == true) {
                    $this->_redirect('/blog');
                } else {
                    //$flash = $this->_helper->getHelper('FlashMessenger');   
                    $flash = $this->_helper->FlashMessenger($login);
                    $this->view->messages = $flash->getMessages();
                }
            }
        }

        $this->view->form = $form;
    }

}

