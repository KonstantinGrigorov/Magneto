<?php

class Magicstore_Blog_Adminhtml_PostsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('blog');
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_blog'));
        $this->renderLayout();
    }
    
    public function massDeleteAction()
    {
        $posts = $this->getRequest()->getParam('posts', null);

        if (is_array($posts) && sizeof($posts) > 0) {
            try {
                foreach ($posts as $id) {
                    Mage::getModel('blog/posts')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d posts have been deleted', sizeof($posts)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select posts!'));
        }
        $this->_redirect('*/*');
    }
    
    public function newAction()
    {
        $this->_forward('edit');
    }
    
    public function editAction()
    {
        $postid = (int) $this->getRequest()->getParam('post_id');
        $model = Mage::getModel('blog/posts');
        
        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $model->setData($data)->setId($postid);
        } else {
            $model->load($postid);
        }
        
        
        Mage::register('current_post', $model);

        $this->loadLayout()->_setActiveMenu('blog');
        $this->_addLeft($this->getLayout()->createBlock('blog/adminhtml_blog_edit_tabs'));
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_blog_edit'));
        $this->renderLayout();
    }
    
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
           
            try {
                $helper = Mage::helper('blog');
                $model = Mage::getModel('blog/posts');
                $model->setData($data)->setId($this->getRequest()->getParam('post_id'));
                if(!$model->getPostCreated()){
                    $model->setPostCreated(now());
                }else if(!$model->getPostUpdated()){
                    $model->setPostUpdated(now());
                    
                }
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Post was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('post_id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }
    
    public function deleteAction()
    {
        $id = (int)$this->getRequest()->getParam('post_id');
            try {
                Mage::getModel('blog/posts')->setPostId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Post was deleted successfully'));
                return $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        
        $this->_redirect('*/*/');
    }
}