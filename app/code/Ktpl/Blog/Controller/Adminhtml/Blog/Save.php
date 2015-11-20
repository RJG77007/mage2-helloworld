<?php

namespace Ktpl\Blog\Controller\Adminhtml\Blog;

use Ktpl\Blog\Controller\Adminhtml\Blog;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;

class Save extends Blog
{
    /**
    * @return void
    */               
    
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();

        if ($isPost) {
            $blogModel = $this->_blogFactory->create();
            $blogId = $this->getRequest()->getParam('id');

            if ($blogId) {
                $blogModel->load($blogId);
            }             
            $formData = $this->getRequest()->getParam('blog');
            


            
            try{
                
             //   DebugBreak();
                $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader',['fileId' => 'banner']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                $result = $uploader->save($mediaDirectory->getAbsolutePath(\Ktpl\Blog\Model\Blog::BASE_MEDIA_PATH));
                $formData['banner'] = \Ktpl\Blog\Model\Blog::BASE_MEDIA_PATH . $result['file'];


            }   catch (\Exception $e) 
            {
                $this->messageManager->addError($e->getMessage());
                if (isset($isPost['banner']) && isset($isPost['banner']['value'])) {
                    if (isset($data['banner']['delete'])) {
                        $isPost['banner'] = null;
                        $isPost['delete_image'] = true;
                    } else if (isset($data['banner']['value'])) {
                        $isPost['banner'] = $isPost['banner']['value'];
                    } else {
                        $isPost['banner'] = null;
                    }
                }
            }
            try {

                // Save news
                $blogModel->setData($formData);
                $blogModel->save();

                // Display success message
                $this->messageManager->addSuccess(__('The Blog has been saved.'));

                // Check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $blogModel->getId(), '_current' => true]);
                    return;
                }

                // Go to grid page
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }

            $this->_getSession()->setFormData($formData);
            $this->_redirect('*/*/edit', ['id' => $blogId]);
        }
    }
}