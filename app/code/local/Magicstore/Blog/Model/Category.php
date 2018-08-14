<?php

class Magicstore_Blog_Model_Category extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        parent::_construct();
        $this->_init('blog/category');
    }
    
    public function getImageUrl()
    {
        $helper = Mage::helper('blog');
        if ($this->getId() && file_exists($helper->getImagePath($this->getId()))) {
            return $helper->getImageUrl($this->getId());
        }
        return null;
    }
    
    protected function _afterDelete()
    {
        $postsCollection = Mage::getModel('blog/posts')->getCollection()
            ->addFieldToFilter('category_id', $this->getId());
        foreach($postsCollection as $post){
            $post->setCategoryId(0)->save();
        }
        return parent::_afterDelete();
    }
    
    public function getPostsCollection()
    {
        $collection = Mage::getModel('blog/posts')->getCollection();
        $collection->addFieldToFilter('category_id', $this->getCategoryId());
        return $collection;
    }

}
