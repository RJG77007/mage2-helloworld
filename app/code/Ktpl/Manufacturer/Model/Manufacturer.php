<?php
 
namespace Ktpl\Manufacturer\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Manufacturer extends AbstractModel
{
    /**
     * Define resource model
     */
     const BASE_MEDIA_PATH = 'blog/images/';
    protected function _construct()
    {
        $this->_init('Ktpl\Manufacturer\Model\Resource\Manufacturer');
    }
}