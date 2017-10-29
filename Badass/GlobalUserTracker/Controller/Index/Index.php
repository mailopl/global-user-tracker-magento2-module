<?php

namespace Badass\GlobalUserTracker\Controller\Index;

use Badass\GlobalUserTracker\Model\ResourceModel\Statistics;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\AlreadyExistsException;

class Index extends Action
{
    /** @var JsonFactory */
    private $resultJsonFactory;

    public function __construct(Context $context, JsonFactory $resultJsonFactory)
    {
        $this->resultJsonFactory = $resultJsonFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create([
            'success' => false
        ]);

        try {
            $parameters = $this->getRequest()->getParams();
            $this->saveStatisticsRecord($parameters);
        } catch (AlreadyExistsException $e) {
            return $result;
        }

        return $result->setData(['success' => true]);
    }

    private function saveStatisticsRecord(array $params)
    {
        $statisticsResourceModel = $this->_objectManager->create(Statistics::class);
        $statisticsResourceModel->insertStatistic($params['guid'], $params['productId']);
    }
}