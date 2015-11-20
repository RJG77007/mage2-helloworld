<?php
namespace Ktpl\Manufacturer\Model;

use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\ScopeInterface;
use Ktpl\Manufacturer\Model\ManufacturerFactory;


class Observer
{
    protected $scopeConfig;
    protected $storeManager;
    protected $manufacturerfactory;



    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Ktpl\Manufacturer\Model\ManufacturerFactory $manufacturerfactory
    ) {

        $this->scopeConfig  = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->_manufacturerfactory = $manufacturerfactory;

    }

    public function storepid(\Magento\Framework\Event\Observer $observer)
    {  
        DebugBreak();
        $pid                = $observer->getEvent()->getProduct()->getID();
        $mfc_id             = $observer->getEvent()->getProduct()->getData('manufacturer');
        $storeScope         = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $collection         = $this->_manufacturerfactory->create()->getCollection()->addFieldToFilter('mfc_id',$mfc_id);
        if($collection){
            foreach ($collection as $data){
                $row                = $data->getData('pid');
                if($row!="")
                {
                    $pid             = $row.",".$pid;
                }else{
                    $pid             = $pid;
                }
                $collection = $this->_manufacturerfactory->create()->setPid($pid)->addFieldToFilter('mfc_id', array('eq' =>$mfc_id));
                $collection->save();
            }
        }
        //$this->_redirect('*/*/');
        return;
    }
}