<?php

namespace Ktpl\Manufacturer\Block\Adminhtml\Manufacturer\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Ktpl\Manufacturer\Model\System\Config\Status;

class Info extends Generic implements TabInterface
{
    /**
    * @var \Magento\Cms\Model\Wysiwyg\Config
    */
    protected $_wysiwygConfig;
    protected $objectManager;
    protected $_manufacturerStatus;
    /**
    * @param Context $context
    * @param Registry $registry
    * @param FormFactory $formFactory
    * @param Config $wysiwygConfig
    * @param array $data
    */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $manufacturerStatus,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_manufacturerStatus = $manufacturerStatus;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->objectManager = $objectManager;
    }

    /**
    * Prepare form fields
    *
    * @return \Magento\Backend\Block\Widget\Form
    */
    protected function _prepareForm()
    {
        $form               =   $this->_formFactory->create();
        $form->setHtmlIdPrefix('manufacturer_');
        $form->setFieldNameSuffix('manufacturer');
        $model              =   $this->_coreRegistry->registry('manufacturer_manufacturer');
        $om                 =   \Magento\Framework\App\ObjectManager::getInstance();
        $reader             =   $om->get('Magento\Eav\Model\Config')->getAttribute('catalog_product','manufacturer');
        $attributeOptions   =   $reader->getSource()->getAllOptions(true, true);
        $default            =   array('value'=>'','label'=>'Choose Brand');
        $i=0;
        $manufacturer[$i]   =   $default;
        foreach($attributeOptions as $key=>$value){
            $i++;  
            if($key!=0){
            $manufacturer[$i]=$value; 
            //$name[$i] = $value['label'];
            }
            
        }
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );

        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'mfc_id',
            'select',
            [
                'name'        => 'mfc_id',
                'label'    => __('Manufacturer'),
                'required'     => true,
                'values'    =>$manufacturer, 
            ]
        );
        
       
        $fieldset->addField(
            'status',
            'select',
            [
                'name'      => 'status',
                'label'     => __('Status'),
                'options'   => $this->_manufacturerStatus->toOptionArray()
            ]
        );
        $fieldset->addField(
            'position',
            'textarea',
            [
                'name'      => 'position',
                'label'     => __('Position'),
                'required'  => true,
                'style'     => 'height: 15em; width: 30em;'
            ]
        );

        $fieldset->addField(
            'image_path',
            'image',
            array(
                'name' => 'image_path',
                'label' => __('Image'),
                'title' => __('Image')
            )
        );
        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'description',
            'editor',
            [
                'name'        => 'description',
                'label'    => __('Description'),
                'required'     => true,
                'config'    => $wysiwygConfig
            ]
        );

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
    * Prepare label for tab
    *
    * @return string
    */
    public function getTabLabel()
    {
        return __('Manufacturer Info');
    }

    /**
    * Prepare title for tab
    *
    * @return string
    */
    public function getTabTitle()
    {
        return __('Manufacturer Info');
    }

    /**
    * {@inheritdoc}
    */
    public function canShowTab()
    {
        return true;
    }

    /**
    * {@inheritdoc}
    */
    public function isHidden()
    {
        return false;
    }
}
