<?php

class Application_Model_Tags extends Zend_Db_Table_Abstract
{
    protected $_name = 'tbl_tags';
    protected $_dependentTables = Array('Application_Model_AssocTags');

}

