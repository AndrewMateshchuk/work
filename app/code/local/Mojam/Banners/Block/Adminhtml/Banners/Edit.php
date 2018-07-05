<?php
class Mojam_Banners_Block_Adminhtml_Banners_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'mojambanners';
        $this->_controller = 'adminhtml_banners';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('mojambanners');
        $model = Mage::registry('current_banners');

        if ($model->getId()) {
            return $helper->__("Edit banners item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add banners item");
        }
    }

}