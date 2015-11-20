<?php
 
namespace Ktpl\Blog\Model\Resource\Blog;
 
use Magento\Framework\Model\Resource\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Ktpl\Blog\Model\Blog',
            'Ktpl\Blog\Model\Resource\Blog'
        );
    }
}