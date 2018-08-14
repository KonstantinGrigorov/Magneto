<?php

class Magicstore_Blog_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function viewAction()
    {
       
        $postId = (int) Mage::app()->getRequest()->getParam('id', 0);
        $post = Mage::getModel('blog/posts')->load($postId);
        $helper = Mage::helper('blog');
        
        if ($post->getPostId() > 0) {
            
            $this->loadLayout();
            $this->getLayout()->getBlock('onepost.content')->assign(array(
                "postItem" => $post,
                "categoryName"=>$helper->getCategoryName($post->getCategoryId())
            ));
            $this->renderLayout();
            
        } else {
            $this->_forward('noRoute');
        }
    }
    
    public function categoryviewAction()
    {
       
        $catId = (int) Mage::app()->getRequest()->getParam('id', 0);
        $category = Mage::getModel('blog/category')->load($catId);
        
        if ($category->getCategoryId() > 0) {
            
            $this->loadLayout();
            $this->getLayout()->getBlock('onecategory.content')->assign(array(
                "categoryItem" => $category,
            ));
            $this->renderLayout();
            
        } else {
            $this->_forward('noRoute');
        }
    }

}
