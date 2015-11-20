<?php

namespace Ktpl\Blog\Block\Adminhtml\Blog\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Ktpl\Blog\Model\System\Config\Status;

class Info extends Generic implements TabInterface
{
    /**
    * @var \Magento\Cms\Model\Wysiwyg\Config
    */
    protected $_wysiwygConfig;

    /**
    */
    protected $_blogStatus;

    /**
    * @param Context $context
    * @param Registry $registry
    * @param FormFactory $formFactory
    * @param Config $wysiwygConfig
    * @param array $data
    */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $blogStatus,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_blogStatus = $blogStatus;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
    * Prepare form fields
    *
    * @return \Magento\Backend\Block\Widget\Form
    */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('blog_blog');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('blog_');
        $form->setFieldNameSuffix('blog');

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
            'title',
            'text',
            [
                'name'        => 'title',
                'label'    => __('Title'),
                'required'     => true
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name'      => 'status',
                'label'     => __('Status'),
                'options'   => $this->_blogStatus->toOptionArray()
            ]
        );
        $fieldset->addField(
            'summary',
            'textarea',
            [
                'name'      => 'summary',
                'label'     => __('Summary'),
                'required'  => true,
                'style'     => 'height: 15em; width: 30em;'
            ]
        );

        $fieldset->addField(
            'banner',
            'image',
            array(
                'name' => 'banner',
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
        return __('Blog Info');
    }

    /**
    * Prepare title for tab
    *
    * @return string
    */
    public function getTabTitle()
    {
        return __('Blog Info');
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
