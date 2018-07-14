<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Magicstore_Lesson_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index action
     */
    public function indexAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
}