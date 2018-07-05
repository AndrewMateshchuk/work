<?php

class Mojam_Banners_Adminhtml_BannersController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('');
        $this->_addContent($this->getLayout()->createBlock('mojambanners/adminhtml_banners'));
        $this->renderLayout();
    }
    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('current_banners', Mage::getModel('mojambanners/banners')->load($id));

        $this->loadLayout()->_setActiveMenu('mojambanners');
        $this->_addContent($this->getLayout()->createBlock('mojambanners/adminhtml_banners_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('mojambanners');
                $model = Mage::getModel('mojambanners/banners');

                $model->setData($data)->setId($id);
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                $model->save();
                $id = $model->getId();

                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($helper->getImagePath(), $id . '.jpg'); // Upload the image
                } else {
                    if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {
                        @unlink($helper->getImagePath($id));
                    }
                }

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Banners was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $id
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('mojambanners/banners')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('banners was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }
    public function massDeleteAction()
    {
        $banners = $this->getRequest()->getParam('banners', null);

        if (is_array($banners) && sizeof($banners) > 0) {
            try {
                foreach ($banners as $id) {
                    Mage::getModel('mojambanners/banners')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d banners have been deleted', sizeof($banners)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select banners'));
        }
        $this->_redirect('*/*');
    }
}