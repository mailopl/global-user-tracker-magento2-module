<?php
namespace Badass\GlobalUserTracker\Controller\Adminhtml\Statistics;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /** @var PageFactory */
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load page from view/adminhtml/layout/globalusertracker_statistics_index.xml
     *
     * @return Page
     */
    public function execute()
    {
        /** @var Page $page */
        return $this->resultPageFactory->create();
    }
}
