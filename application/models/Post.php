<?php

class Application_Model_Post extends Zend_Db_Table_Abstract
{
    protected $_name = 'tbl_post';
    protected $_dependentTables = Array('Application_Model_AssocTags');


}

