<?php

class Default_PostController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $acl = new Zend_Acl();
        $visitante = new Zend_Acl_Role('visitante');
        $acl->addRole($visitante)
                //->addRole(new Zend_Acl_Role('editor'),'visitante') 
                ->addRole(new Zend_Acl_Role('admin'), 'visitante') /* tudo que é de visitante tbm é de admin */
                ->add(new Zend_Acl_Resource('index')) /* acao */
                ->add(new Zend_Acl_Resource('add')) /* acao */
                ->allow('visitante', array('index'/*,'ver'*/)) /* define quais os recursos (actions) permitidos p/ o visitante */
                ->allow('admin', 'add') /* não precisava fazer isso pq ele já herdou ali em cima */
                //->deny('editor','add')
                ;

        /* pega o nome da action automaticamente */
        $action = $this->_request->getActionName();
        
        if ($acl->isAllowed('admin', $action)) {
            echo 'Sim, o visitante tem acesso';
        }
        else
            echo 'Não, o visitante não tem acesso';
    }

    public function verAction() {
        
    }
    
    public function indexAction() {
        // action body

        /* PAGINAÇÃO */

        /* melhor fazer  isso nos model isso */
        //$post = new Application_Model_Post;

        /*
         * após mover as pastas controller, forms, models, views, foi preciso renomear
         * de Application_Model_Post  para Default_Model_Post 
         *  */
        $post = new Default_Model_Post;

        $select = $post->select()->order('id Desc');
        /* fim - melhor fazer isso nos model isso */

        /* array de 1 a 100 */
        //$data = range(1, 100);

        /* 1 forma de instanciar  - adaptador */
        //$adapter = new Zend_Paginator_Adapter_Array($data);

        /* 1 forma de instanciar  - instancia */
        //$paginator = new Zend_Paginator($adapter);

        /* 2 forma de instanciar - não precisa de adaptador */
        $paginator = Zend_Paginator::factory($select /* ou  $data */);

        /*
         * determina uma variavel p/ diferenciar as paginas
         * CONTROLER/?page=5
         *  */
        $paginator->setCurrentPageNumber($this->_getParam('page'));

        /* qtde de itens por pagina */
        $paginator->setItemCountPerPage(2);

        /* qtde de paginas que poderão ser clicadas */
        $paginator->setPageRange(5);

        /* estilo de rolamento */
        $paginator->setDefaultScrollingStyle('Elastic');

        /* determina o arquivo default de paginação */
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator_control.phtml');

        /*  exibe na view */
        $this->view->paginator = $paginator;
    }

    /* FUNÇÃO P/ ADICIONAR UM POST NO BANCO */

    public function addAction() {
        $form = new Default_Form_Post();
        $model = new Default_Model_Post;

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

                /* CASO ATUALIZAR */
                if ($id) {
                    /* FILTRA POR ID */
                    $where = $model->getAdapter()->quoteInto('id = ?', $id);

                    /* ATUALIZA */
                    $model->update($data, $where);
                }
                else
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

