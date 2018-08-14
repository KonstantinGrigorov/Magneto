<?php

class Magicstore_Blog_Block_Adminhtml_Blog_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'blog';
        $this->_controller = 'adminhtml_blog';
        
        $this->_addButton('delete', array(
            'label'     => Mage::helper('lesson')->__('Delete'),
            'onclick'   => 'deleteConfirm("Are you sure that want to delete this?")',
            'class'     => 'scalable',
        ), -100);      
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('blog');
        $model = Mage::registry('current_post');

        if ($model->getPostId()) {
            return $helper->__("Edit post item '%s'", $this->escapeHtml($model->getPostName()));
        } else {
            return $helper->__("Add post item");
        }
    }

}