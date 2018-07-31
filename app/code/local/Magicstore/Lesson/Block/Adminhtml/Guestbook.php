<?php

class Magicstore_Lesson_Block_Adminhtml_Guestbook extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'lesson'; //имя модуля
        $this->_controller = 'adminhtml_guestbook';//путь относительно корня, где лежит grid
        $this->_headerText = Mage::helper('lesson')->__('Guestbook requests');

        parent::__construct();
       // $this->_removeButton('add');
    }
}
