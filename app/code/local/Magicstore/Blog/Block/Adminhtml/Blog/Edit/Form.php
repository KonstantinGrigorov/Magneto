<?php

class Magicstore_Blog_Block_Adminhtml_Blog_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    //Инициализируем форму
    public function __construct()
    {
        //die('pr');
        parent::__construct();
        $this->setId('blog_request');
        $this->setTitle(Mage::helper('blog')->__('Request info'));
    }
    
    protected function _prepareForm()
    {
        $helper = Mage::helper('blog');
        $model = Mage::registry('current_post');
        $form = new Varien_Data_Form(array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', array(
                        'id' => $this->getRequest()->getParam('post_id')
                    )),
                    'method' => 'post',
                    
                ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('posts_form', array('legend' => $helper->__('Blog Information')));

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
        ));
//        $fieldset->addField('post_status', 'text', array(
//            'label' => $helper->__('Status'),
//            'required' => true,
//            'name' => 'post_status',
//        ));
        $fieldset->addField('post_status', 'select', array(
          'label'     => $helper->__('Category'),
          'required'  => true,
          'name'      => 'post_status',
          'values' => array('-1'=>'Please Select..','1' => 'enable','2' => 'disable'),
        ));
        
//        $fieldset->addField('category_id', 'text', array(
//            'label' => $helper->__('Category'),
//            'required' => true,
//            'name' => 'category_id',
//        ));
//        
        $fieldset->addField('category_id', 'select', array(
          'label'     => $helper->__('Category'),
          'required'  => true,
          'name'      => 'category_id',
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'values' => array('-1'=>'Please Select..','1' => 'sport','2' => 'politic'),
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