<?php

class Magicstore_Blog_Block_Adminhtml_Category_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('blog/category')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $helper = Mage::helper('blog');

        $this->addColumn('category_id', array(
            'header' => $helper->__('Category ID'),
            'index' => 'category_id'
        ));

        $this->addColumn('category_name', array(
            'header' => $helper->__('Title'),
            'index' => 'category_name',
            'type' => 'text',
        ));
        
        $this->addColumn('category_description', array(
            'header' => $helper->__('Discription'),
            'index' => 'category_description',
            'type' => 'text',
        ));
        
        $this->addColumn('category_image', array(
            'header' => $helper->__('Image'),
            'index' => 'category_image',
            'type' => 'text',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
                    'category_id' => $model->getCategoryId(),
                ));
    }

}