<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Magicstore_Lesson_Model_Resource_Contact extends Mage_Core_Model_Resource_Db_Abstract 
{
    protected function _construct() 
    {
        //die('www4');
        $this->_init('lesson/contact');
    }
}