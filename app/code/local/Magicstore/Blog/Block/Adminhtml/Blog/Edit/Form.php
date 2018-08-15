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
        $form = new Varien_Data_Form(array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', array(
                        'id' => (int)$this->getRequest()->getParam('post_id')
                    )),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}