<?php
 
namespace Ktpl\Manufacturer\Model\Resource\Manufacturer;
 
use Magento\Framework\Model\Resource\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Ktpl\Manufacturer\Model\Manufacturer',
            'Ktpl\Manufacturer\Model\Resource\Manufacturer'
        );
    }
}
