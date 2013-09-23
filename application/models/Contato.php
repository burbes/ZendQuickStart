<?php

class Application_Model_Contato extends Zend_Db_Table_Abstract
{
    protected $_name = 'tb_contato';
    protected $_referenceMap = Array(
        'Usuario' => Array(
            'columns' => 'fk_usuario',
            'refTableClass' => 'Application_Model_Usuario',
            'refColumn' => 'id'
            )
    );

}

