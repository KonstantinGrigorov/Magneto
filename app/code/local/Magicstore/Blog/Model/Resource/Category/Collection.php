<?php

class Magicstore_Blog_Model_Resource_Category_Collection extends 
Mage_Core_Model_Resource_Db_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('blog/category');
    }

}