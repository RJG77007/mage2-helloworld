<?php

namespace Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;

use Ktpl\Manufacturer\Controller\Adminhtml\Manufacturer;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;

class Save extends Manufacturer
{
    /**
    * @return void
    */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $manufacturerModel = $this->_manufacturerFactory->create();
            $manufacturerId = $this->getRequest()->getParam('id');

            if ($manufacturerId) {
                $manufacturerModel->load($manufacturerId);
            }
            $formData = $this->getRequest()->getParam('manufacturer');
            try{

                //   DebugBreak();
                $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader',['fileId' => 'image_path']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                $result = $uploader->save($mediaDirectory->getAbsolutePath(\Ktpl\Manufacturer\Model\Manufacturer::BASE_MEDIA_PATH));
                $formData['image_path'] = \Ktpl\Manufacturer\Model\Manufacturer::BASE_MEDIA_PATH . $result['file'];


            }   catch (\Exception $e) 
            {
                $this->messageManager->addError($e->getMessage());
                if (isset($isPost['image_path']) && isset($isPost['image_path']['value'])) {
                    if (isset($data['image_path']['delete'])) {
                        $isPost['image_path'] = null;
                        $isPost['delete_image'] = true;
                    } else if (isset($data['image_path']['value'])) {
                        $isPost['image_path'] = $isPost['image_path']['value'];
                    } else {
                        $isPost['image_path'] = null;
                    }
                }
            }

            $is_available  = $manufacturerModel->getCollection()->addFieldToFilter('mfc_id','230');
            if($is_available){
                $this->messageManager->addError("Manufacturer Already Exist");
            }else{
                $manufacturerModel->setData($formData);    
            }


            try {
                // Save news
                $manufacturerModel->save();

                // Display success message
                $this->messageManager->addSuccess(__('The manufacturer has been saved.'));

                // Check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $manufacturerModel->getId(), '_current' => true]);
                    return;
                }

                // Go to grid page
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }

            $this->_getSession()->setFormData($formData);
            $this->_redirect('*/*/edit', ['id' => $manufacturerId]);
        }
    }
}