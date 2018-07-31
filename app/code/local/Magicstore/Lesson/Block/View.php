<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Magicstore_Lesson_Block_View extends Mage_Core_Block_Template 
{
//    protected function _toHtml() 
//    {
//        die('www00');
//        return "Hello, world!";
//    }
    public function getRequestedRecord() {
        //die('www2');
        //Zend_Debug::dump(Mage::getModel('lesson/contact')->load(1)); die('www');
        return Mage::getModel('lesson/contact')->getCollection();
    }

}