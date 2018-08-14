<?php

class Magicstore_Blog_Model_Resource_Category extends Mage_Core_Model_Resource_Db_Abstract
{

    public function _construct()
    {
        $this->_init('blog/table_categories', 'category_id');
    }

}