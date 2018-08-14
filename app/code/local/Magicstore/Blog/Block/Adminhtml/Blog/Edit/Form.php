<?php

class Magicstore_Blog_Block_Adminhtml_Blog_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('blog_request');
        $this->setTitle(Mage::helper('blog')->__('Request info'));
    }
    
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
    
    protected function _prepareForm()
    {
        $helper = Mage::helper('blog');
        $model = Mage::registry('current_post');
        $form = new Varien_Data_Form(array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', array(
                        'id' => (int)$this->getRequest()->getParam('post_id')
                    )),
                    'method' => 'post',
                    
                ));
        $this->setForm($form);

        $fieldset = $form->addFieldset('posts_form', array('legend' => $helper->__('Blog Information')));
        
        if ($this->getRequest()->getParam('post_id')) {
            $fieldset->addField('post_id', 'hidden', [
                'label' => $helper->__('id'),
                'name' => 'post_id',
            ]);
        }
        $fieldset->addField('post_name', 'text', array(
            'label' => $helper->__('Title'),
            'required' => true,
            'name' => 'post_name',
        ));

        $fieldset->addField('post_discription', 'editor', array(
            'label' => $helper->__('Discription'),
            'required' => true,
            'name' => 'post_discription',
        ));
        $fieldset->addField('post_content', 'editor', array(
            'label' => $helper->__('Content'),
            'required' => true,
            'name' => 'post_content',
            'wysiwyg' => true, 
        ));

        $fieldset->addField('post_status', 'select', array(
          'label'     => $helper->__('Category'),
          'required'  => true,
          'name'      => 'post_status',
          'values' => array('0'=>'disable','1' => 'enable'),
        ));
        

        $fieldset->addField('category_id', 'select', array(
          'label'     => $helper->__('Category'),
          'required'  => true,
          'name'      => 'category_id',
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'values' => array('1'=>'Culture','2' => 'sport','3' => 'politic'),
          'disabled' => false,
          'readonly' => false,
          'after_element_html' => '<small>Choose a post category, please</small>',
          'tabindex' => 1
        ));

        $fieldset->addField('post_created', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => $helper->__('Created'),
            'name' => 'post_created'
        ));
        
        $fieldset->addField('post_updated', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => $helper->__('Updated'),
            'name' => 'post_updated'
        ));

        $form->setUseContainer(true);

        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }

}