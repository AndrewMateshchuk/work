<?php

class Mojam_Banners_Model_Resource_Banners extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('mojambanners/table_banners', 'banners_id');
    }

}