<?php
 
namespace Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
use Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
class NewAction extends Manufacturer
{
   /**
     * Create new news action
     *
     * @return void
     */
   public function execute()
   {
      $this->_forward('edit');
   }
}
 