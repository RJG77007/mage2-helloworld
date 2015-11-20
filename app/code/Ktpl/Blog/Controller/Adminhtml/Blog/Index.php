<?php
 
namespace Ktpl\Blog\Controller\Adminhtml\Blog;
 
use Ktpl\Blog\Controller\Adminhtml\Blog;
 
class Index extends Blog
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
        $resultPage->setActiveMenu('Ktpl_Blog::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Simple Blog'));
 
        return $resultPage;
   }
}