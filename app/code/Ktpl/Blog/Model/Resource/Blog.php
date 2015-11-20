<?php
 
namespace Ktpl\Blog\Model\Resource;
 
use Magento\Framework\Model\Resource\Db\AbstractDb;
 
class Blog extends AbstractDb
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('ktpl_blog', 'id');
    }
}