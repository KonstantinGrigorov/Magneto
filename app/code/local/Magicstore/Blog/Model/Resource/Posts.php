<?php

class Magicstore_Blog_Model_Resource_Posts extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('blog/table_post', 'post_id');
    }

}