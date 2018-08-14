<?php

class Magicstore_Blog_Block_Posts extends Mage_Core_Block_Template
{

    public function getPostsCollection()
    {
        $postCollection = Mage::getModel('blog/posts')->getCollection();
        $postCollection->setOrder('post_id', 'DESC');
        return $postCollection;
    }
    public function getCategoryCollection()
    {
        $postCollection = Mage::getModel('blog/category')->getCollection();
        $postCollection->setOrder('category_id', 'DESC');
        return $postCollection;
    }
    public function getCategoryPostsCollection($id)
    {
        $collection = Mage::getModel('blog/posts')->getCollection();
        $collection->addFieldToFilter('category_id', $id);
        return $collection;
    }

}