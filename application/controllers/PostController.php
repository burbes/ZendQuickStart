<?php

class PostController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    /* FUNÇÃO P/ ADICIONAR UM POST NO BANCO */

    public function addAction() {
        $form = new Application_Form_Post();
        $model = new Application_Model_Post;

        /* GET POST SERVE P/ PEGAR OS VALORES DO SUBMIT */
        //var_dump($this->_request->getPost());
        //$id = $this->_request->getParam('id',null /* não precisa por null, é padrão */); /* OUTRA FORMA DE FAZER */
        $id = $this->getParam('id');

        /* FORMULARIO FOI SUBMETIDO? */
        if ($this->_request->isPost()) {

            /* ESTA VALIDO? */
            if ($form->isValid($this->_request->getPost())) {

                /* PEGA OS VALORES */
                $data = $form->getValues();
                //var_dump($data);
                if ($id) {
                    /* FILTRA POR ID */
                    $where = $model->getAdapter()->quoteInto('id = ?', $id);

                    /* ATUALIZA */
                    $model->update($data, $where);
                }

                $model->insert($data);

                $this->_redirect('/post');
            }
        } elseif ($id) {

            /* PROCURA POR UM ID */
            $data = $model->busca($id);

            /* VERIFICA SE EXISTE */
            if (is_array($data)) {
                /* SETA A ACTION EM ESPECIFICO P/ ESSA PAGINA 
                 * ISSO É USADAO P/ PODER FAZER O UPDATE */
                $form->setAction('/post/add/id/' . $id);
                
                /* POPULA O FORMULARIO */
                $form->populate($data);

                /* EXEMPLO P/ INVOCAR O FORM POPULADO
                 * http://quick.com.br/post/add/id/2 */
            }
        }

        /* Armazena o formulario p/ exibir na view */
        $this->view->form = $form;
    }

}

