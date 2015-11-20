<?php
 
namespace Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
use Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
class Index extends Manufacturer
{
    /**
     * @return void
     */
   public function execute()
   {
      if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }
        
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Ktpl_Manufacturer::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Manufacturer'));
 
        return $resultPage;
   }
}