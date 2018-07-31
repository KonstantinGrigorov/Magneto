<?php


class Magicstore_Lesson_Block_Adminhtml_Guestbook_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'request_id';
        $this->_blockGroup = 'lesson';
        $this->_controller = 'adminhtml_guestbook';
        $this->_mode = 'edit';

        parent::__construct();
        
        $request_id = (int)$this->getRequest()->getParams('request_id');
        // var_dump($request_id);die('www1');
        $request = Mage::getModel('lesson/contact')->load($request_id);
        
        //Mage::register('guestbook_request', $request);
        // var_dump($request);die('www3');
        $this->_updateButton('save', 'label', Mage::helper('lesson')->__('Save Request'));
        $this->_updateButton('delete', 'label', Mage::helper('lesson')->__('Delete Request'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('lesson')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('block_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'block_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'block_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        //die('pr1');
         //var_dump(Mage::registry('current_guestbook')->getRequestId());die('www0');
        if (Mage::registry('current_guestbook')->getRequestId()) {
            return Mage::helper('lesson')->__("Edit Request # %s", $this->escapeHtml(Mage::registry('current_guestbook')->getRequestId()));
        }
        else {
            return Mage::helper('lesson')->__('New Request');
        }
    }

}
