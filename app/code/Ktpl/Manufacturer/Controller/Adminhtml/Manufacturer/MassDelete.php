<?php
 
namespace Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
use Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
class MassDelete extends Manufacturer
{
   /**
    * @return void
    */
   public function execute()
   {
      // Get IDs of the selected news
      $manufacturerIds = $this->getRequest()->getParam('manufacturer');
 
        foreach ($manufacturerIds as $mfcId) {
            try {
               /** @var $newsModel \Mageworld\SimpleNews\Model\News */
                $newsModel = $this->_newsFactory->create();
                $newsModel->load($mfcId)->delete();
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
 
        if (count($manufacturerIds)) {
            $this->messageManager->addSuccess(
                __('A total of %1 record(s) were deleted.', count($manufacturerIds))
            );
        }
 
        $this->_redirect('*/*/index');
   }
}
 