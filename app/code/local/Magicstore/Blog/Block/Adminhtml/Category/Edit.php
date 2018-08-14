<?php

class Magicstore_Blog_Block_Adminhtml_Category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'blog';
        $this->_controller = 'adminhtml_category';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('blog');
        $model = Mage::registry('current_category');

        if ($model->getCategoryId()) {
            return $helper->__("Edit Category '%s'", $this->escapeHtml($model->getCategoryName()));
        } else {
            return $helper->__("Add Category");
        }
    }

}