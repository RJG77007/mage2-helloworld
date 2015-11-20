<?php
 
namespace Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
use Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
class Delete extends Manufacturer
{
   /**
    * @return void
    */
   public function execute()
   {
      $manufacturerId = (int) $this->getRequest()->getParam('id');
 
      if ($manufacturerId) {
         /** @var $newsModel \Mageworld\SimpleNews\Model\News */
         $manufacturerModel = $this->_manufacturerFactory->create();
         $manufacturerModel->load($manufacturerId);
 
         // Check this news exists or not
         if (!$manufacturerModel->getId()) {
            $this->messageManager->addError(__('This manufacturer no longer exists.'));
         } else {
               try {
                  // Delete news
                  $manufacturerModel->delete();
                  $this->messageManager->addSuccess(__('The manufacturer has been deleted.'));
 
                  // Redirect to grid page
                  $this->_redirect('*/*/');
                  return;
               } catch (\Exception $e) {
                   $this->messageManager->addError($e->getMessage());
                   $this->_redirect('*/*/edit', ['id' => $manufacturerModel->getId()]);
               }
            }
      }
   }
}