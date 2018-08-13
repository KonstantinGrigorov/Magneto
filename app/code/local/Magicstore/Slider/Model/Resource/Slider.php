<?php

class Magicstore_Slider_Model_Resource_News extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('slider/slides_table', 'slide_id');
    }

}