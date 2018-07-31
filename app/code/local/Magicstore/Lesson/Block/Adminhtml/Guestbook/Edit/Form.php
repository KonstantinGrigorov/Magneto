<?php

class Magicstore_Lesson_Block_Adminhtml_Guestbook_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    
    //Инициализируем форму
    public function __construct()
    {
        //die('pr');
        parent::__construct();
        $this->setId('guestbook_request');
        $this->setTitle(Mage::helper('lesson')->__('Request info'));
    }

    //Загружаем Wysiwyg и подготавливаем layout
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('current_guestbook');
        //var_dump($model);die;
        $form = new Varien_Data_Form(
            ['id' => 'edit_form', 
            'action' => $this->getUrl('*/*/save', 
                    array('id' => $this->getRequest()->getParam('request_id'))
             ), 
             'method' => 'post']
        );

        $form->setHtmlIdPrefix('block_');

        $fieldset = $form->addFieldset('base_fieldset', [
            'legend' => Mage::helper('lesson')->__('General Information'),
            'class' => 'fieldset-wide'
        ]);

        if ($model->getRequestId()) {
            $fieldset->addField('request_id', 'hidden', [
                'name' => 'request_id',
            ]);
        }

        $fieldset->addField('name', 'text', [
            'name'     => 'name',
            'label'    => Mage::helper('lesson')->__('Contact Name'),
            'title'    => Mage::helper('lesson')->__('Contact Name'),
            'required' => true,
        ]);

        $fieldset->addField('contact', 'editor', [
            'name'     => 'contact',
            'label'    => Mage::helper('lesson')->__('Comment'),
            'title'    => Mage::helper('lesson')->__('Comment'),
            'style'    => 'height:36em',
            'required' => true,
            //'config'   => Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('add_variables' => false, 'add_widgets' => false,'files_browser_window_url'=>$this->getBaseUrl().'admin/cms_wysiwyg_images/index/')),
            'wysiwyg' => true, 
        ]);

        $form->setMethod('post');
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
