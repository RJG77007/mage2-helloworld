<?php
 
namespace Ktpl\Manufacturer\Model\Resource;
 
use Magento\Framework\Model\Resource\Db\AbstractDb;
 
class Manufacturer extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('ktpl_manufacturer', 'id');
    }     
}