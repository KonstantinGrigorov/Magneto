<?php

class Magicstore_Blog_Model_Posts extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('blog/posts');
    }

}