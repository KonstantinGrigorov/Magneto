<?php

class Magicstore_Blog_Block_Adminhtml_Category_Edit_Tabs_General extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {

        $helper = Mage::helper('blog');
        $model = Mage::registry('current_category');

        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('general_form', array('legend' => $helper->__('General Information')));

        $fieldset->addField('category_name', 'text', array(
            'label' => $helper->__('Title'),
            'required' => true,
            'name' => 'category_name',
        ));
        
        $fieldset->addField('category_description', 'text', array(
            'label' => $helper->__('Discription'),
            'required' => true,
            'name' => 'category_description',
        ));
        $fieldset->addField('category_image', 'text', array(
            'label' => $helper->__('Image'),
            'required' => true,
            'name' => 'category_image',
        ));

        $formData = array_merge($model->getData(), array('category_image' => $model->getImageUrl()));
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
