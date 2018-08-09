<?php

class Magicstore_Lesson_Model_Observer
{
    public function addChina(Varien_Event_Observer $observer){
        
        
        $blockId = $observer->getEvent()->getBlockId();
        $block = Mage::getModel('cms/block')->load($blockId);
        $block->setContent($block->getContent() . 'Made In China');
    }
    
}