<?php

class Mojam_Banners_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function viewAction()
    {
        $newsId = Mage::app()->getRequest()->getParam('id', 0);
        $banners = Mage::getModel('mojambanners/banners')->load($newsId);

        if ($banners->getId() > 0) {
            $this->loadLayout();
            $this->getLayout()->getBlock('banners.content')->assign(array(
                "bannersItem" => $banners,
            ));
            $this->renderLayout();
        } else {
            $this->_forward('noRoute');
        }
    }

}