<?php

class Application_Model_AssocTags extends Zend_Db_Table_Abstract
{
    protected $_name = 'tbl_assoc_post_tags';
    protected $_referenceMap = Array(
        'Post' => Array(
            'columns' => 'fk_post',
            'refTableClass' => 'Application_Model_Post',
            'refCikynbs' => 'id'
        ),
        'Tags' => Array(
            'columns' => 'fk_tags',
            'refTableClass' => 'Application_Model_Tags',
            'refCikynbs' => 'id')
    );

}

