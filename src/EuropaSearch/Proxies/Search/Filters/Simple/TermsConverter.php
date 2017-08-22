<?php

/**
 * @file
 * Contains EC\EuropaSearch\Proxies\Search\Filters\Simple\TermsConverter.
 */

namespace EC\EuropaSearch\Proxies\Search\Filters\Simple;

use EC\EuropaSearch\Messages\DocumentMetadata\BooleanMetadata;
use EC\EuropaSearch\Messages\DocumentMetadata\DateMetadata;
use EC\EuropaWS\Messages\Components\ComponentInterface;

/**
 * Class TermsConverter.
 *
 * It defines the default mechanism for parsing Terms fitler into a format that
 * is JSON convertible.
 * It works with the Dynamic schema of the Europa Search services.
 *
 * @package EC\EuropaSearch\Proxies\Search\Filters\Simple
 */
class TermsConverter extends AbstractSimpleConverter
{

    /**
     * {@inheritDoc}
     */
    public function convertComponent(ComponentInterface $component)
    {

        $metadata = $component->getImpliedMetadata();
        $name = $metadata->getEuropaSearchName();

        $convertedValues = $component->getTestedValues();

        if ($metadata instanceof DateMetadata) {
            $convertedValues = $this->getConvertedDateValues($convertedValues);
        } elseif ($metadata instanceof BooleanMetadata) {
            $convertedValues = $this->getBooleanMetadataValues($convertedValues);
        }

        $convertedValue = [$name => $convertedValues];

        $boost = $component->getBoost();
        if (isset($boost)) {
            $convertedValue['boost'] = $component->getBoost();
        }

        return ["terms" => $convertedValue];
    }

    /**
     *  Gets the date value consumable by Europa Search service.
     *
     * @param array $values
     *   The raw date value to convert.
     * @return array $finalValues
     *   The converted date values.
     */
    private function getConvertedDateValues($values)
    {

        $finalValues = [];
        foreach ($values as $item) {
            $finalValues[] = $this->getConvertedDateValue($item);
        }

        return $finalValues;
    }

    /**
     * Gets the boolean value consumable by Europa Search service.
     *
     * @param array $values
     *   The raw date values to convert.
     * @return array $finalValue
     *   The converted date values.
     */
    private function getBooleanMetadataValues($values)
    {

        $finalValue = [];
        foreach ($values as $item) {
            $finalValue[] = boolval($item);
        }

        return $finalValue;
    }
}
