<?php

namespace Ktpl\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_ENABLED      = 'blog/general/enable_in_frontend';
    const XML_PATH_HEAD_TITLE   = 'blog/general/head_title';
    const XML_PATH_LASTEST_NEWS = 'blog/general/blog_block_position';
    const XML_PATH_AUTO_SLIDER = 'blog/general/auto_slider';
    const XML_PATH_SLIDING_SPEED = 'blog/general/auto_slider_timing';
    const XML_PATH_SHOW_CONTROLS = 'blog/general/show_controls';

    /**
    * @var \Magento\Framework\App\Config\ScopeConfigInterface
    */
    protected $_scopeConfig;

    /**
    * @param Context $context
    * @param ScopeConfigInterface $scopeConfig
    */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->_scopeConfig = $scopeConfig;
    }

    /**
    * Check for module is enabled in frontend
    *
    * @return bool
    */
    public function isEnabledInFrontend($store = null)
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
    * Get head title for news list page
    *
    * @return string
    */
    public function getHeadTitle()
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_HEAD_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
    * Get lastest news block position (Left, Right, Disabled)
    *
    * @return int
    */
    public function getLastestBlogBlockPosition()
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_LASTEST_NEWS,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getAutoSliding()
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_AUTO_SLIDER,
            ScopeInterface::SCOPE_STORE
        );
    }
    public function getSlidingSpeed()
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_SLIDING_SPEED,
            ScopeInterface::SCOPE_STORE
        );
    }
    public function getShowControls()
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_SHOW_CONTROLS,
            ScopeInterface::SCOPE_STORE
        );
    }
}
