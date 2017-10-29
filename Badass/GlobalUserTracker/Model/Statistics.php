<?php

namespace Badass\GlobalUserTracker\Model;

use Magento\Framework\Model\AbstractModel;

class Statistics extends AbstractModel
{
    /** @var int */
    private $productId;

    /** @var int */
    private $guid;

    /** @var string */
    private $createdAt;

    protected function _construct()
    {
        $this->_init(\Badass\GlobalUserTracker\Model\ResourceModel\Statistics::class);
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    public function getGuid()
    {
        return $this->guid;
    }

    public function setProductId(int $productId)
    {
        $this->productId = $productId;
    }

    public function getProductId()
    {
        return $this->productId;
    }
}
