<?php
namespace Ktpl\Blog\Model;

use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\ScopeInterface;

class Observer
{
    const XML_PATH_EMAIL_RECIPIENT = 'contact/email/recipient_email';
    const XML_PATH_EMAIL_SENDER = 'contact/email/sender_email_identity';
    protected $_transportBuilder;
    protected $inlineTranslation;
    protected $scopeConfig;
    protected $storeManager;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {

        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    public function sendemail(\Magento\Framework\Event\Observer $observer)
    {  
        
        try{
            $postObject = array();
            $this->inlineTranslation->suspend();
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->_transportBuilder
            ->setTemplateIdentifier('new_product_notification')
            ->setTemplateOptions(
                [
                    'area' => \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE,
                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                ]
            )
            ->setTemplateVars(['data' => $observer->getEvent()->getProduct()])
            ->setFrom($this->scopeConfig->getValue(self::XML_PATH_EMAIL_SENDER, $storeScope))
            ->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
            ->setReplyTo("devrj77007@gmail.com")
            ->getTransport();

            $transport->sendMessage();
            $this->inlineTranslation->resume();
        }  catch (\Exception $e) {
            $this->inlineTranslation->resume();
            $this->messageManager->addError(
                __('Unable To send Message')
            );
            $this->_redirect('*/*/');
            return;
        }








     }


}