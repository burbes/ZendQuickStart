<?php

        /*
         * após mover as pastas controller, forms, models, views, foi preciso renomear
         * de Application_Model_Usuario  para Default_Model_Usuario 
         *  */
class Default_Model_Usuario extends Zend_Db_Table /* extensão do db */ {

    protected $_name = 'tb_usuario';
    protected $_fkname = 'tb_contato';
    protected $_primary = 'id';
    protected $_dependentTables = Array('Default_Model_Contato');
    

    public function listar($id = null) {
        try {

            if (!empty($id)) {
                /* otimo caminho p/ tratar o sql injection */
                $where = $this->getAdapter()->quoteInto('id = ?', $id);
            }
            else
                $where = null;

            return $this->fetchAll($where);

            //return $this->fetchAll();
            //return $this->fetchRow(); /* Retorna apenas uma linha  */
            //return $this->fetchAll('id=3')->toArray();
            //return $this->fetchAll('id=3')->toArray();
        } catch (Zend_Db_Exception $e) {
            
        }
    }

    public function inserir(Array $dados) {
        try {
            $dados = self::colunas($dados);

            /* parent - busca da classe extendida */
            //$this->insert($dados); /* assim funciona tbm - mas sobrescreve caso tenha 2 com o mesmo nome */
            parent::insert($dados);


            //var_dump(self::colunas($dados));
        } catch (Zend_Db_Exception $e) {
            /* Retorna apenas o codigo p/ visualização */
            //return $e->getCode();
            echo $e->getMessage();
        }
    }

    public function update(Array $dados, $id) {
        try {
            $where = $this->getAdapter()->quoteInto('id = ?', $id);
            $dados = self::colunas($dados);

            return parent::update($dados, $where);
        } catch (Zend_Db_Exception $e) {
            /* Retorna apenas o codigo p/ visualização */
            echo $e->getMessage();
        }
    }

    public function delete($id) {

        try {
            $where = $this->getAdapter()->quoteInto('id = ?', $id);
            return parent::delete($where);
        } catch (Zend_Db_Exception $e) {
            /* Retorna apenas o codigo p/ visualização */
            echo $e->getMessage();
        }
    }

    public function sql(/* $id */) {
        $sql = $this->select()
                //->where("id = ?",$id)
                //->from($this->_name, Array('idUsuario' => 'id', 'nome')) /* exemplo de alias p/ colunas */
                ->from(Array('usu'=>$this->_name), Array('id'))
                ->setIntegrityCheck(false) /* pode listar as colunas  */
                ->join(Array('con'=> $this->_fkname),'con.fk_usuario=usu.id',Array('Telefone','Celular')) /* Lista somente o Telefone e Celular */
                ->columns(Array('nomeUsuario' => 'nome','Email'))
                ->order("id desc")
                ->group("usu.id")
                ->limit(5);
        echo $sql;
        return $this->fetchAll($sql)->toArray();


        //$sql->where("id = ?",$id); /* outra forma de chamar metodos */
        //echo $sql;
    }

    /*
     * METODO QUE COLOA APENAS OS DADOS REFERENTE A TABELA DO BANCO
     * @param Array $dados Os dados a serem verificados
     * @return Array 
     * */

    protected function colunas(Array $dados) {

        $ret = Array();

        foreach ($dados as $coluna => $valor) {
            if (in_array($coluna, $this->_getCols()))
                $ret[$coluna] = $valor;
        }
        return $ret;
    }

}

