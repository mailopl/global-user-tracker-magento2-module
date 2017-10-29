<?php

namespace Badass\GlobalUserTracker\Model\ResourceModel\Statistics;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(
            \Badass\GlobalUserTracker\Model\Statistics::class,
            \Badass\GlobalUserTracker\Model\ResourceModel\Statistics::class
        );
    }

    public function fetchProductViewsHistory()
    {
        // TODO: Refactor
        $statistics = $this->getConnection()->fetchAll(
            'SELECT cpev.value as title, guid, productId, createdAt
            FROM global_user_statistics 
            LEFT JOIN catalog_product_entity_varchar cpev 
            ON cpev.entity_id = productId AND cpev.attribute_id = (
              SELECT attribute_id
              FROM eav_attribute
              WHERE entity_type_id=4
              AND attribute_code="name"
            );'
        );

        $statisticUserBuckets = [];
        foreach($statistics as $statistic) {
            $guid = $statistic['guid'];

            $statisticUserBuckets[$guid][] = [
                'title' => $statistic['title'],
                'createdAt' => $statistic['createdAt']
            ];
        }

        return $statisticUserBuckets;
    }

    public function fetchMostViewedProducts()
    {
        $mostViewed = $this->getConnection()->fetchAll(
            'SELECT cpev.value AS title, productId, count(*) AS views 
            FROM global_user_statistics
            LEFT JOIN catalog_product_entity_varchar cpev
            ON cpev.entity_id = productId AND cpev.attribute_id = (
                SELECT attribute_id
                FROM eav_attribute
                WHERE entity_type_id=4
                AND attribute_code="name"
            )
            GROUP BY productId
            LIMIT 10;'
        );

        return $mostViewed;
    }
}
