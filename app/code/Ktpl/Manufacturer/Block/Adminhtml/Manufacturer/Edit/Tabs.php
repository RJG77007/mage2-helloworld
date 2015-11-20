<?php
 
namespace Ktpl\Manufacturer\Block\Adminhtml\Manufacturer\Edit;
 
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
        $this->setId('manufacturer_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Manufacturer Information'));
    }
 
    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'manufacturer_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'Ktpl\Manufacturer\Block\Adminhtml\Manufacturer\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );
         $this->addTab(
                'related',
                [
                    'label' => __('Related Products'),
                    'url' => $this->getUrl('catalog/product/related', ['_current' => true]),
                    'class' => 'ajax',
                    
                ]
            ) ;
 
        return parent::_beforeToHtml();
    }
}