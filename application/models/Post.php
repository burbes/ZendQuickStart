<?php

class Application_Model_Post extends Zend_Db_Table_Abstract {

    protected $_name = 'tbl_post';
    protected $_dependentTables = Array('Application_Model_AssocTags');

    public function busca($id) {
        try {
            $sql = $this->select()
                        ->where("id = ?", $id);
            $row = $this->fetchRow($sql);

            if (null !== $row) {
                return $row->toArray();
            }

            //$row = $this->fetchRow("id = ($id)"); /* OUTRA FORMA */
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

