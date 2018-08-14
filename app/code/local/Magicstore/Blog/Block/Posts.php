<?php

class Magicstore_Blog_Block_Posts extends Mage_Core_Block_Template
{

    public function getPostsCollection()
    {
        $postCollection = Mage::getModel('blog/posts')->getCollection();
        $postCollection->setOrder('post_id', 'DESC');
        return $postCollection;
    }

}