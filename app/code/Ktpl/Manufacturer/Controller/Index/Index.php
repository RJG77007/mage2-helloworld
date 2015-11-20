<?php
 
namespace Ktpl\Manufacturer\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ktpl\Manufacturer\Model\ManufacturerFactory;
 
class Index extends Action
{
    /**
     * @var \Tutorial\SimpleNews\Model\NewsFactory
     */
    protected $_modelManufacturerFactory;
 
    /**
     * @param Context $context
     * @param NewsFactory $modelNewsFactory
     */
    public function __construct(
        Context $context,
        ManufacturerFactory $modelManufacturerFactory
    ) {
        parent::__construct($context);
        $this->_modelManufacturerFactory = $modelManufacturerFactory;
    }
 
    public function execute()
    {
        /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */
        $newsModel = $this->_modelManufacturerFactory->create();
        $newsCollection = $newsModel->getCollection();
        var_dump($newsCollection->getData());
    }
}