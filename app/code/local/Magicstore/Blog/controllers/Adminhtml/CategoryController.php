<?php

class Magicstore_Blog_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('blog');
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_category'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('category_id');
        $model = Mage::getModel('blog/category');

        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $model->setData($data)->setCategoryId($id);
        } else {
            $model->load($id);
        }
        Mage::register('current_category', $model);

        $this->loadLayout()->_setActiveMenu('blog');

        $this->_addLeft($this->getLayout()->createBlock('blog/adminhtml_category_edit_tabs'));
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_category_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $id = $this->getRequest()->getParam('category_id');
        if ($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('blog');
                $model = Mage::getModel('blog/category');

                $model->setData($data)->setCategoryId($id);
                $model->save();

                $id = $model->getCategoryId();
                
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg','png'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($helper->getImagePath(), $id . '.jpg'); // Upload the image
                } else {
                    if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {
                        @unlink($helper->getImagePath($id));
                    }
                }


                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Category was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'category_id' => $id
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('category_id')) {
            try {
                Mage::getModel('blog/category')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Category was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }
    
    public function postsAction()
    {
        $id = (int) $this->getRequest()->getParam('category_id');
        $model = Mage::getModel('blog/category')->load($id);
        Mage::register('current_category', $model);

        if (Mage::app()->getRequest()->isAjax()) {
            $this->loadLayout();
            echo $this->getLayout()->createBlock('blog/adminhtml_category_edit_tabs_posts')->toHtml();
        }
    }

}