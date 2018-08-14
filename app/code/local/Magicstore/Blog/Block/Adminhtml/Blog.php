<?php

class Magicstore_Blog_Block_Adminhtml_Blog extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();
        
        $helper = Mage::helper('blog');
        $this->_blockGroup = 'blog';
        $this->_controller = 'adminhtml_blog';
         
        $this->_headerText = $helper->__('Blog Management');
        $this->_addButtonLabel = $helper->__('Add post');
    }
    

}