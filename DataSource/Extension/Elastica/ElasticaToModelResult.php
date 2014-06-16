<?php

namespace FSi\Bundle\DataSourceBundle\DataSource\Extension\Elastica;

use Doctrine\Common\Collections\ArrayCollection;
use Elastica\ResultSet;
use FOS\ElasticaBundle\Transformer\ElasticaToModelTransformerInterface;

class ElasticaToModelResult extends ArrayCollection
{
    /**
     * @var \Elastica\ResultSet
     */
    private $resultSet;

    public function __construct(ElasticaToModelTransformerInterface $transformer, ResultSet $resultSet)
    {
        $this->resultSet = $resultSet;

        parent::__construct($transformer->transform($this->resultSet->getResults()));
    }

    public function count()
    {
        return $this->resultSet->getTotalHits();
    }
}
