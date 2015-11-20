<?php
 
namespace Ktpl\Blog\Block\Adminhtml;
 
use Magento\Backend\Block\Widget\Grid\Container;
 
class Blog extends Container
{
   /**
     * Constructor
     *
     * @return void
     */
   protected function _construct()
    {
        $this->_controller = 'adminhtml_blog';
        $this->_blockGroup = 'Ktpl_Blog';
        $this->_headerText = __('Manage Blog');
        $this->_addButtonLabel = __('Add Blog');
        parent::_construct();
    }
}