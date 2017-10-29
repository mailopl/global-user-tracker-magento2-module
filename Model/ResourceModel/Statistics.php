<?php

namespace Badass\GlobalUserTracker\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Statistics extends AbstractDb
{
    /** @var DateTime */
    protected $_coreDate;

    /** @var RemoteAddress */
    protected $_remoteAddress;

    public function __construct(Context $context, DateTime $coreDate, $connectionName = null)
    {
        $this->_coreDate = $coreDate;

        parent::__construct($context, $connectionName);
    }

    public function insertStatistic(string $guid, int $productId)
    {
        $this->getConnection()->insertOnDuplicate(
            $this->getMainTable(),
            [
                'guid' => $guid,
                'productId' => $productId,
                'createdAt' => $this->_coreDate->gmtDate()
            ]
        );

        return $this;
    }

    protected function _beforeSave(AbstractModel $object)
    {
        if (!$this->isValidGuid($object)) {
            throw new LocalizedException(__('GUID is not valid.'));
        }
    }

    protected function _construct()
    {
        $this->_setMainTable('global_user_statistics');
    }

    private function isValidGuid(AbstractModel $object) : bool
    {
        // TODO: add better validation
        return !empty($object->getGuid());
    }
}
