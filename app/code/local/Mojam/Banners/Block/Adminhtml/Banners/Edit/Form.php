<?php

class Mojam_Banners_Block_Adminhtml_Banners_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('mojambanners');
        $model = Mage::registry('current_banners');

        $form = new Varien_Data_Form(array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', array(
                        'id' => $this->getRequest()->getParam('id')
                    )),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('banners_form', array('legend' => $helper->__('banners Information')));

        $fieldset->addField('title', 'text', array(
            'label' => $helper->__('Title'),
            'required' => true,
            'name' => 'title',
        ));

        $fieldset->addField('url', 'text', array(
            'label' => $helper->__('URL'),
            'required' => true,
            'name' => 'url',
        ));
        $fieldset->addField('image', 'image', array(
            'label' => $helper->__('Image'),
            'required' => true,
            'name' => 'image',
        ));
        
        $form->setUseContainer(true);
        $data = array_merge($model->getData(), array('image' => $model->getImageUrl()));
        $form->setValues($data);

        return parent::_prepareForm();
    }

}