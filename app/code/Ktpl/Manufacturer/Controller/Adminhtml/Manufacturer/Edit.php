<?php
 
namespace Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
use Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
 
class Edit extends Manufacturer
{
   /**
     * @return void
     */
   public function execute()
   {
      $manufacturerId = $this->getRequest()->getParam('id');
        /** @var \Tutorial\SimpleNews\Model\News $model */
        $model = $this->_manufacturerFactory->create();
 
        if ($manufacturerId) {
            $model->load($manufacturerId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This manufacturer no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
 
        // Restore previously entered form data from session
        $data = $this->_session->getManufacturerData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('manufacturer_manufacturer', $model);
 
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Ktpl_Manufacturer::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Manufacturer'));
 
        return $resultPage;
   }
}