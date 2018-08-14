<?php

class Magicstore_Blog_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getImagePath($id = 0)
    {
        $path = Mage::getBaseDir('media') . '/blog';
        if ($id) {
            return "{$path}/{$id}.jpg";
        } else {
            return $path;
        }
    }

    public function getImageUrl($id = 0)
    {
        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'blog/';
        if ($id) {
            return $url . $id . '.jpg';
        } else {
            return $url;
        }
    }

    public function getCategoriesList()
    {
        $categories = Mage::getModel('blog/category')->getCollection()->load();
        $output = array();
        foreach($categories as $category){
            $output[$category->getCategoryId()] = $category->getCategoryName();
        }
        return $output;
    }

    public function getCategoriesOptions()
    {
        $categories = Mage::getModel('blog/category')->getCollection()->load();
        $options = array();

        foreach ($categories as $category) {
            $options[] = array(
                'label' => $category->getCategoryName(),
                'value' => $category->getCategoryId(),
            );
        }
        return $options;
    }
    
    public function getCategoryName($id)
    {
        $category = Mage::getModel('blog/category')->load($id);
        $categoryName = $category->getCategoryName();
        return $categoryName;
    }
}