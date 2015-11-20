<?php
 
namespace Ktpl\Blog\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Blog extends AbstractModel
{
    /**
     * Define resource model
     */
     const BASE_MEDIA_PATH = 'manufacturer/images/';
    protected function _construct()
    {
        $this->_init('Ktpl\Blog\Model\Resource\Blog');
    }
}