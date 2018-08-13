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

        if ($post->getPostId() > 0) {
            
            $this->loadLayout();
            $this->getLayout()->getBlock('onepost.content')->assign(array(
                "postItem" => $post,
            ));
            $this->renderLayout();
            
        } else {
            $this->_forward('noRoute');
        }
    }

}
