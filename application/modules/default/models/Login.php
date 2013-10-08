<?php

class Default_Model_Login {

    public static function login($login, $senha) {
        $model = new self;

        $db = Zend_Db_Table::getDefaultAdapter();

        //1 FORMA
        $adapter = new Zend_Auth_Adapter_DbTable($db, 
                'tb_usuario', 
                'email', 
                'senha'
                /*,'SHA1(?)'*/
                /* , 'SHA1(?)' ou 'MD5(?)' */
        );
        //2 FORMA
        /* $adapter = new Zend_Auth_Adapter_DbTable($db);

          $adapter->setIdentityColumn('email')
          ->setCredentialColumn('senha')
          ->setTableName('tb_usuario');
         */

        $select = $adapter->getDbSelect();//->where('acesso = "Y"');
        $select->where('acesso = "Y"');
        $adapter->setIdentity($login);
        $adapter->setCredential($senha);

        //metodo singleton
        $auth = Zend_Auth::getInstance();

        $result = $auth->authenticate($adapter);
        //var_dump($select);
        //die;

        if ($result->isValid()) {
            /* todos os dados da tabela */
            //$data = $adapter->getResultRowObject(array('nome','email','id'));
            $data = $adapter->getResultRowObject(null,'senha'); /* só não retorna o campo senha */
            
            /* abre sessão e insere os dados */
            $auth->getStorage()->write($data);
            
            //var_dump($data);
            //die;
            return true;
        } else {
            return $model->getMessages($result);
        }
    }

    public function getMessages(Zend_Auth_Result $result) {
        switch ($result->getCode()) {
            case $result::FAILURE_IDENTITY_NOT_FOUND:
                $msg = "Login não encontrado";
                break;
            case $result::FAILURE_IDENTITY_AMBIGUOUS:
                $msg = "Login em duplicidade";
                break;
            case $result::FAILURE_CREDENTIAL_INVALID:
                $msg = "Login não corresponde";
                break;

            default:
                //case $result::FAILUE:
                //case $result::FAILUE_UNCATEGORIZED:
                $msg = "Login e/ou senha não encontrados";
                break;
        }
        return $msg;
    }

}