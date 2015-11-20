<?php
 
namespace Ktpl\Blog\Controller\Adminhtml\Blog;
 
use Ktpl\Blog\Controller\Adminhtml\Blog;
 
class Delete extends Blog
{
   /**
    * @return void
    */
   public function execute()
   {
      $blogId = (int) $this->getRequest()->getParam('id');
 
      if ($blogId) {
         /** @var $newsModel \Mageworld\SimpleNews\Model\News */
         $blogModel = $this->_blogFactory->create();
         $blogModel->load($blogId);
 
         // Check this news exists or not
         if (!$blogModel->getId()) {
            $this->messageManager->addError(__('This Blog no longer exists.'));
         } else {
               try {
                  // Delete news
                  $blogModel->delete();
                  $this->messageManager->addSuccess(__('The Blog has been deleted.'));
 
                  // Redirect to grid page
                  $this->_redirect('*/*/');
                  return;
               } catch (\Exception $e) {
                   $this->messageManager->addError($e->getMessage());
                   $this->_redirect('*/*/edit', ['id' => $blogModel->getId()]);
               }
            }
      }
   }
}
 