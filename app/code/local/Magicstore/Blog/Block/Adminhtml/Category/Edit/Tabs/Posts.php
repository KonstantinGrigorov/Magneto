<?php

class Magicstore_Blog_Block_Adminhtml_Category_Edit_Tabs_Posts extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('categoryPostsGrid');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::registry('current_category')->getPostsCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $helper = Mage::helper('blog');

        $this->addColumn('ajax_grid_post_id', array(
            'header' => $helper->__('Post ID'),
            'index' => 'post_id',
            'width' => '100px',
        ));

        $this->addColumn('ajax_grid_post_title', array(
            'header' => $helper->__('Title'),
            'index' => 'post_name',
            'type' => 'text',
        ));

        $this->addColumn('ajax_grid_post_created', array(
            'header' => $helper->__('Created'),
            'index' => 'post_created',
            'type' => 'date',
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/posts', array('_current' => true));
    }

}