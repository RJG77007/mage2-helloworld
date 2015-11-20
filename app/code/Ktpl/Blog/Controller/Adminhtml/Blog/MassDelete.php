<?php
 
namespace Ktpl\Blog\Controller\Adminhtml\Blog;
 
use Ktpl\Blog\Controller\Adminhtml\Blog;
 
class MassDelete extends Blog
{
   /**
    * @return void
    */
   public function execute()
   {
      // Get IDs of the selected news
      $blogIds = $this->getRequest()->getParam('blog');
 
        foreach ($blogIds as $bId) {
            try {
               /** @var $newsModel \Mageworld\SimpleNews\Model\News */
                $blogModel = $this->_blogFactory->create();
                $blogModel->load($bId)->delete();
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
 
        if (count($blogIds)) {
            $this->messageManager->addSuccess(
                __('A total of %1 record(s) were deleted.', count($blogIds))
            );
        }
 
        $this->_redirect('*/*/index');
   }
}