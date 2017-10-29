<?php

namespace Badass\GlobalUserTracker\Controller\Index;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class User extends Action
{
    private $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}