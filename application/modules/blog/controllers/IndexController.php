<?php

class Blog_IndexController extends Zend_Controller_Action {

    /* METODO EXECUTADO ANTES DE QUALQUER COISA  */
    public function preDispatch() {
        parent::preDispatch();

        $auth = Zend_Auth::getInstance();

        /* CHECA SE O USUARIO ESTÁ COM SESSÃO ABERTA */
        if (!$auth->hasIdentity()) {
            $this->_helper->FlashMessenger(array('erro' => 'Acesso Negado'));
            $this->_redirect('/login');
        }
    }

    public function init() {
        
    }

    public function indexAction() {

        /* obj da sessão */
        $auth = Zend_Auth::getInstance();

        /* retorna os objs em sessão */
        $data = ($auth->getStorage()->read()); //ou $auth->getIdentity()
        //var_dump($data->email);die;

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