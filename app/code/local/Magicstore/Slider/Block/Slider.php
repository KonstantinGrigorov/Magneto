<?php
class Magicstore_Slider_Block_News extends Mage_Core_Block_Template
{

    public function getSlideCollection()
    {
        $newsCollection = Mage::getModel('slider/slider')->getCollection();
        return $newsCollection;
    }

}
