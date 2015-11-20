<?php
 
namespace Ktpl\Blog\Controller\Adminhtml\Blog;
 
use Ktpl\Blog\Controller\Adminhtml\Blog;
 
class Edit extends Blog
{
   /**
     * @return void
     */
   public function execute()
   {
      $blogId = $this->getRequest()->getParam('id');
        $model = $this->_blogFactory->create();
 
        if ($blogId) {
            $model->load($blogId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Blog no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
 
        // Restore previously entered form data from session
        $data = $this->_session->getBlogData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('blog_blog', $model);
 
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Ktpl_Blog::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Simple Blog'));
 
        return $resultPage;
   }
}