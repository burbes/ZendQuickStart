<?php

//use Application_Model_Usuario;

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
        /* EXEMPLOS DE CONECTORES
          $db = new Zend_Db_Adapter_Mysqli(array());
          $db = new Zend_Db_Adapter_Oracle(array());
         */

        /* 1 MANEIRA DE SE CONECTAR NO BANCO 
          $db = new Zend_Db_Adapter_Pdo_Mysql(
          array(
          'host' => 'localhost',
          'username' => 'root',
          'password' => '',
          'dbname' => 'quick',
          'charset' => 'UTF8'
          ));
          /* FIM - 1 MANEIRA DE SE CONECTAR NO BANCO */

        /* 2 MANEIRA DE SE CONECTAR NO BANCO  
          $db = Zend_Db::factory('Pdo_Mysql',
          array(
          'host' => 'localhost',
          'username' => 'root',
          'password' => '',
          'dbname' => 'quick',
          'charset' => 'UTF8'
          ));

          /* FIM - 2 MANEIRA DE SE CONECTAR NO BANCO */

        /* 3 MANEIRA DE SE CONECTAR NO BANCO (ideal) */
        $db = Zend_Db_Table::getDefaultAdapter();
        /* FIM - 3 MANEIRA DE SE CONECTAR NO BANCO */

        //var_dump($db);

        /* consulta */
        //$sql = 'select * from tb_usuario';

        /*  retorna uma linha */
        //$row = $db->fetchRow($sql);

        /*  retorna varias linhas */
        //$row = $db->fetchAll($sql);

        /* pesquisa por id especifico (evita sql injection) */
        //$row = $db->fetchAll('select * from tb_usuario where id = ?',1);

        /* insere registro */
        //$ins = $db->insert('tb_usuario',array('nome'=>'gtivideoaulas','email'=>'gtivideoaulas@gmail.com','senha'=>'gtivideoaulas'));
        //$ins = $db->insert('tb_usuario',array('nome'=>'gtivideoaulas2','email'=>'2gtivideoaulas@gmail.com','senha'=>'2gtivideoaulas'));

        /* atualiza registro */
        //$update = $db->update('tb_usuario', array('nome'=>'GtivideoaulasPri'),'id=4');

        /* remover registro */
        //$delete = $db->delete('tb_usuario','id=4');

        /* pega o ultimo registro inserido pelo metodo insert */
        //$ultimoid = $db->lastInsertId();

        /*         * ********************************************************************************** */
        /* RETORNA UM OBJ AO INVÉS DE UM ARRAY */
        $db->setFetchMode(Zend_Db::FETCH_OBJ);

        /* fazendo consulta (exemplo repitido) */
        //$rows = $db->fetchAll('select * from tb_usuario');

        /* instancia o model Usuario */
        $usuario = new Application_Model_Usuario();

        /* chama o metodo listar */
        $rows = $usuario->listar();

        /* passando parametor */
        //$rows = $usuario->listar(3);
        
        //Inserir os dados        
        //$ins = $usuario->inserir(array('nome' => 'Video aulas Brasil','email'=>'vab@videoaulasbrasil.com.br','salvar'=>'salvar'));
        //echo "Ultimo id inserido $ins";

        /* ATUALIZAR */
        //$update = $usuario->update(Array('nome' => 'MxMasters'), 3);
        
        /* DELETAR */
        //$delete = $usuario->delete(7);

        $sql = $usuario->sql(3);
        
        var_dump($sql);
        
        //Views
        $this->view->titulo = "Usuários"; /* TITULO DA VIEW */
        $this->view->usuarios = $rows; /* USUÁRIOS DA CONSULTA */
    }

    public function verAction() {
        // action body
    }

}

