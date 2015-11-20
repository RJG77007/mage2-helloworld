<?php
 
namespace Ktpl\Blog\Model\System\Config\LastestBlog;
 
use Magento\Framework\Option\ArrayInterface;
 
class Status implements ArrayInterface
{
    const false      = 'false';
    const true     = 'true';
    
 
    
    public function toOptionArray()
    {
        return [
            self::true => __('True'),
            self::false => __('False'),
            
        ];
    }
}