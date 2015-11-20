<?php
 
namespace Ktpl\Blog\Controller\Adminhtml\Blog;
 
use Ktpl\Blog\Controller\Adminhtml\Blog;
 
class NewAction extends Blog
{
   /**
     * Create new news action
     *
     * @return void
     */
   public function execute()
   {
      $this->_forward('edit');
   }
}