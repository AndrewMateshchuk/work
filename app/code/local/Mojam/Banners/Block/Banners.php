<?php

class Mojam_Banners_Block_Banners extends Mage_Core_Block_Template
{

    public function getNewsCollection()
    {
        $newsCollection = Mage::getModel('mojambanners/banners')->getCollection();
        return $newsCollection;
    }

}