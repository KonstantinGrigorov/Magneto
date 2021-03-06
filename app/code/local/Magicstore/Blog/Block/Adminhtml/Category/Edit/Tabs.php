<?php

class Magicstore_Blog_Block_Adminhtml_Category_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        $helper = Mage::helper('blog');

        parent::__construct();
        $this->setId('category_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($helper->__('Category Information'));
    }

    protected function _prepareLayout()
    {
        $helper = Mage::helper('blog');
        $category = Mage::registry('current_category');
        
        $this->addTab('general_section', array(
            'label' => $helper->__('General Information'),
            'title' => $helper->__('General Information'),
            'content' => $this->getLayout()->createBlock('blog/adminhtml_category_edit_tabs_general')->toHtml(),
        ));
        
        if ($category->getCategoryId()) {
            $this->addTab('posts_section', array(
                'class' => 'ajax',
                'label' => $helper->__('Posts'),
                'title' => $helper->__('Posts'),
                'url' => $this->getUrl('*/*/posts', array('_current' => true)),
            ));
        }
        return parent::_prepareLayout();
    }

}
