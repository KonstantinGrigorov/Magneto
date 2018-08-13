<?php

class Magicstore_Blog_Block_Adminhtml_Blog_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {    //die('www1');
        $collection = Mage::getModel('blog/posts')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
       
    }

    protected function _prepareColumns()
    {
        // die('www2');
        $helper = Mage::helper('blog');

        $this->addColumn('post_id', array(
            'header' => $helper->__('Post ID'),
            'index' => 'post_id'
        ));

        $this->addColumn('post_name', array(
            'header' => $helper->__('Title'),
            'index' => 'post_name',
            'type' => 'text',
        ));

        $this->addColumn('post_discription', array(
            'header' => $helper->__('Discription'),
            'index' => 'post_discription',
            'type' => 'text',
        ));
        
        $this->addColumn('post_content', array(
            'header' => $helper->__('Content'),
            'index' => 'post_content',
            'type' => 'text',
        ));
        $this->addColumn('post_status', array(
            'header' => $helper->__('Status'),
            'index' => 'post_status',
            //'type' => 'select',
             'type'      => 'options',
            'options'   => array(
                1 => Mage::helper('blog')->__('Enabled'),
                0 => Mage::helper('blog')->__('Disabled'))
            
        ));
        
        $this->addColumn('post_created', array(
            'header' => $helper->__('Created'),
            'index' => 'post_created',
            'type' => 'date',
        ));
        
        $this->addColumn('post_updated', array(
            'header' => $helper->__('Last update'),
            'index' => 'post_updated',
            'type' => 'date',
        ));
        
        $this->addColumn('category_id', array(
            'header' => $helper->__('Category'),
            'index' => 'category_id',
            'type'      => 'options',
            'options'   => array(
                1 => Mage::helper('blog')->__('Sport'),
                2 => Mage::helper('blog')->__('Politic'))
        ));
        
        return parent::_prepareColumns();
    }
    
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('post_id');
        $this->getMassactionBlock()->setFormFieldName('posts');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }
    
    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
                    'id' => $model->getId(),
                ));
    }

}