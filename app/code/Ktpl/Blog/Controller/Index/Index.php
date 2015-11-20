<?php
 
namespace Ktpl\Blog\Controller\Index;
 
use Ktpl\Blog\Controller\Blog;
 
class Index extends Blog
{
    public function execute()
    {   
        $pageFactory = $this->_pageFactory->create();
 
        // Add title which is got by the configuration via backend
        $pageFactory->getConfig()->getTitle()->set(
            $this->_dataHelper->getHeadTitle()
        );
 
        // Add breadcrumb
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home',
            [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => $this->_url->getUrl('')
            ]
        );
        $breadcrumbs->addCrumb('blog',
            [
                'label' => __('Simple Blog'),
                'title' => __('Simple Blog')
            ]
        );
 
        return $pageFactory;
    }
}