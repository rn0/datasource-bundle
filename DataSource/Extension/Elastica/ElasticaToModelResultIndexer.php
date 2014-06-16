<?php

namespace FSi\Bundle\DataSourceBundle\DataSource\Extension\Elastica;

use Elastica\ResultSet;
use FOS\ElasticaBundle\Transformer\ElasticaToModelTransformerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FSi\Component\DataSource\Event\DriverEvent\ResultEventArgs;
use FSi\Component\DataSource\Event\DriverEvents;

class ElasticaToModelResultIndexer implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(DriverEvents::POST_GET_RESULT => array('postGetResult', 1024));
    }

    public function postGetResult(ResultEventArgs $event)
    {
        $result = $event->getResult();
        /** @var \FSi\Component\DataSource\Driver\Elastica\ElasticaDriver $driver */
        $driver = $event->getDriver();

        if ($result instanceof ResultSet) {
            $result = new ElasticaToModelResult($driver->getTransformer(), $result);
            $event->setResult($result);
        }
    }
}
