<?php
 
namespace Ktpl\Manufacturer\Block\Adminhtml;
 
use Magento\Backend\Block\Widget\Grid\Container;
 
class Manufacturer extends Container
{
   /**
     * Constructor
     *
     * @return void
     */
   protected function _construct()
    {
        $this->_controller = 'adminhtml_manufacturer';
        $this->_blockGroup = 'Ktpl_Manufacturer';
        $this->_headerText = __('Manage Manufacturer');
        $this->_addButtonLabel = __('Add Manufacturer');
        parent::_construct();
    }
}
 