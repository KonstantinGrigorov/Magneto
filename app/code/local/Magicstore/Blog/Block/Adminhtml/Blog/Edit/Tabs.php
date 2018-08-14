<?php

class Magicstore_Blog_Block_Adminhtml_Blog_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        $helper = Mage::helper('blog');

        parent::__construct();
        $this->setId('posts_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($helper->__('Blog Information'));
    }

    protected function _prepareLayout()
    {
        $helper = Mage::helper('blog');

        $this->addTab('general_section', array(
            'label' => $helper->__('General Information'),
            'title' => $helper->__('General Information'),
            'content' => $this->getLayout()->createBlock('blog/adminhtml_blog_edit_tabs_general')->toHtml(),
        ));
        $this->addTab('custom_section', array(
            'label' => $helper->__('Custom Fields'),
            'title' => $helper->__('Custom Fields'),
            'content' => $this->getLayout()->createBlock('blog/adminhtml_blog_edit_tabs_custom')->toHtml(),
        ));
        return parent::_prepareLayout();
    }

}