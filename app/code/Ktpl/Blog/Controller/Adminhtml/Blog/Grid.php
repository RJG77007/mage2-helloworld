<?php
 
namespace Ktpl\Blog\Controller\Adminhtml\Blog;
 
use Ktpl\Blog\Controller\Adminhtml\Blog;
 
class Grid extends Blog
{
   /**
     * @return void
     */
   public function execute()
   {
      return $this->_resultPageFactory->create();
   }
}