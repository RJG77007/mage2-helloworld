<?php

    namespace Ktpl\Blog\Block\Adminhtml\Blog;

    use Magento\Backend\Block\Widget\Form\Container;
    use Magento\Backend\Block\Widget\Context;
    use Magento\Framework\Registry;


    class Edit extends Container
    {
        protected $_coreRegistry = null;

        /**
        * @param Context $context
        * @param Registry $registry
        * @param array $data
        */
        public function __construct(
            Context $context,
            Registry $registry,
            array $data = []
        ) {
            $this->_coreRegistry = $registry;
            parent::__construct($context, $data);
        }

        /**
        * Class constructor
        *
        * @return void
        */
        protected function _construct()
        {
            $this->_objectId = 'id';
            $this->_controller = 'adminhtml_blog';
            $this->_blockGroup = 'Ktpl_Blog';

            parent::_construct();

            $this->buttonList->update('save', 'label', __('Save'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => [
                                'event' => 'saveAndContinueEdit',
                                'target' => '#edit_form'
                            ]
                        ]
                    ]
                ],
                -100
            );
            $this->buttonList->update('delete', 'label', __('Delete'));
        }

        /**
        * Retrieve text for header element depending on loaded Blog
        * 
        * @return string
        */
        public function getHeaderText()
        {
            $blogRegistry = $this->_coreRegistry->registry('blog_blog');
            if ($blogRegistry->getId()) {
                $blogTitle = $this->escapeHtml($blogRegistry->getTitle());
                return __("Edit Blog '%1'", $blogTitle);
            } else {
                return __('Add Blog');
            }
        }

        /**
        * Prepare layout
        *
        * @return \Magento\Framework\View\Element\AbstractBlock
        */
        protected function _prepareLayout()
        {
            $this->_formScripts[] = "
            function toggleEditor() {
            if (tinyMCE.getInstanceById('post_content') == null) {
            tinyMCE.execCommand('mceAddControl', false, 'post_content');
            } else {
            tinyMCE.execCommand('mceRemoveControl', false, 'post_content');
            }
            };
            ";

            return parent::_prepareLayout();
        }
    }
