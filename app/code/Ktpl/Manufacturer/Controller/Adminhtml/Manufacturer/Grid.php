<?php
 
namespace Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
use Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
class Grid extends Ktpl
{
   /**
     * @return void
     */
   public function execute()
   {
      return $this->_resultPageFactory->create();
   }
}