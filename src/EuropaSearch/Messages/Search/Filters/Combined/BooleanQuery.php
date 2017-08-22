<?php

/**
 * @file
 * Contains EC\EuropaSearch\Messages\Search\Filters\Combined\BooleanQuery.
 */

namespace EC\EuropaSearch\Messages\Search\Filters\Combined;

use EC\EuropaSearch\Messages\Search\Filters\BoostableFilter;
use EC\EuropaSearch\Messages\Search\Filters\Simple\AbstractSimple;
use EC\EuropaWS\Proxies\BasicProxyController;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BooleanQuery.
 *
 * Represents a Boolean query compound of Europa Search; I.E:
 * "An object allowing combining multiple filter type and other compounds."
 *
 * @package EC\EuropaSearch\Messages\Search\Filters\Combined
 */
class BooleanQuery extends BoostableFilter implements CombinedQueryInterface
{
    /**
     * The list of filters that MUST fulfil the search items.
     *
     * @var array
     */
    private $mustFilterList;

    /**
     * The list of filters that SHOULD fulfil the search items.
     *
     * @var array
     */
    private $shouldFilterList;

    /**
     * The list of filters that MUST NOT fulfil the search items.
     *
     * @var array
     */
    private $mustNotFilterList;

    /**
     * BooleanQuery constructor.
     */
    public function __construct()
    {
        $this->mustFilterList = new AggregatedFilters('must');
        $this->shouldFilterList = new AggregatedFilters('should');
        $this->mustNotFilterList = new AggregatedFilters('must_not');
    }

    /**
     * Gets the list of filters that MUST fulfil the search items.
     *
     * @return AggregatedFilters
     *   The list of filters.
     */
    public function getMustFilterList()
    {
        return $this->mustFilterList;
    }

    /**
     * Gets the list of filters that SHOULD fulfil the search items.
     *
     * @return AggregatedFilters
     *   The list of filters.
     */
    public function getShouldFilterList()
    {
        return $this->shouldFilterList;
    }

    /**
     * Gets the list of filters that MUST NOT fulfil the search items.
     *
     * @return AggregatedFilters
     *   The list of filters.
     */
    public function getMustNotFilterList()
    {
        return $this->mustNotFilterList;
    }

    /**
     * Add a simple filter to the filters that MUST fulfil the search items.
     *
     * @param AbstractSimple $filter
     *   The filter to add
     */
    public function addMustSimpleFilter(AbstractSimple $filter)
    {
        $this->mustFilterList->addSimpleFilter($filter);
    }

    /**
     * Add a simple filter to the filters that SHOULD fulfil the search items.
     *
     * @param AbstractSimple $filter
     *   The filter to add
     */
    public function addShouldSimpleFilter(AbstractSimple $filter)
    {
        $this->shouldFilterList->addSimpleFilter($filter);
    }

    /**
     * Add a simple filter to the filters that MUST NOT fulfil the search items.
     *
     * @param AbstractSimple $filter
     *   The filter to add
     */
    public function addMustNotSimpleFilter(AbstractSimple $filter)
    {
        $this->mustNotFilterList->addSimpleFilter($filter);
    }

    /**
     * Add a simple filter to the filters that MUST fulfil the search items.
     *
     * @param CombinedQueryInterface $filter
     *   The filter to add
     */
    public function addMustCombinedFilter(CombinedQueryInterface $filter)
    {
        $this->mustFilterList->addCombinedQuery($filter);
    }

    /**
     * Add a simple filter to the filters that SHOULD fulfil the search items.
     *
     * @param CombinedQueryInterface $filter
     *   The filter to add
     */
    public function addShouldCombinedFilter(CombinedQueryInterface $filter)
    {
        $this->shouldFilterList->addCombinedQuery($filter);
    }

    /**
     * Add a simple filter to the filters that MUST NOT fulfil the search items.
     *
     * @param CombinedQueryInterface $filter
     *   The filter to add
     */
    public function addMustNotCombinedFilter(CombinedQueryInterface $filter)
    {
        $this->mustNotFilterList->addCombinedQuery($filter);
    }

    /**
     * {@inheritDoc}
     */
    public function getConverterIdentifier()
    {
        return BasicProxyController::COMPONENT_ID_PREFIX.'searching.filters.combined.booleanQuery';
    }

    /**
     * {@inheritDoc}
     */
    public static function getConstraints(ClassMetadata $metadata)
    {

        $metadata->addPropertyConstraint('mustFilterList', new Assert\Valid());
        $metadata->addPropertyConstraint('mustNotFilterList', new Assert\Valid());
        $metadata->addPropertyConstraint('shouldFilterList', new Assert\Valid());

        $metadata->addConstraint(new Assert\Callback('validate'));
    }

    /**
     * Special validator callback for BooleanQuery.
     *
     * @param ExecutionContextInterface $context
     * @param int                       $payload
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {

        if (empty($this->getMustFilterList()) && empty($this->getMustNotFilterList()) && empty($this->getShouldFilterList())) {
            $context->buildViolation('At least one of the filter list must filled.')
                ->atPath('mustFilterList')
                ->addViolation();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getChildComponents()
    {
        return [
            $this->mustFilterList,
            $this->mustNotFilterList,
            $this->shouldFilterList,
        ];
    }
}
