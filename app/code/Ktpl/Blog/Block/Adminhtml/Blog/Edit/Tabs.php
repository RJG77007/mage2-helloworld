<?php

namespace Ktpl\Blog\Block\Adminhtml\Blog\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{
    /**
    * Class constructor
    *
    * @return void
    */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('blog_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Blog Information'));
    }

    /**
    * @return $this
    */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'blog_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'Ktpl\Blog\Block\Adminhtml\Blog\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );
        return parent::_beforeToHtml();
    }
}