<?php

namespace Badass\GlobalUserTracker\Block;

use Badass\GlobalUserTracker\Model\ResourceModel\Statistics\Collection;
use Magento\Framework\View\Element\Template\Context;

class Display extends \Magento\Framework\View\Element\Template
{
    /** @var Collection */
    private $statisticsCollection;

    public function __construct(Context $context, Collection $statisticsCollection)
    {
        parent::__construct($context);

        $this->statisticsCollection = $statisticsCollection;
    }

    public function getStatisticBuckets()
    {
        return $this->statisticsCollection->fetchProductViewsHistory();
    }

    public function fetchMostViewedProducts()
    {
        return $this->statisticsCollection->fetchMostViewedProducts();
    }
}