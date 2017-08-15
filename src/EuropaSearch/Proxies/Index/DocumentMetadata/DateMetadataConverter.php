<?php

/**
 * @file
 * Contains EC\EuropaSearch\Proxies\Index\DocumentMetadata\DateMetadataProxy.
 */

namespace EC\EuropaSearch\Proxies\Index\DocumentMetadata;


use EC\EuropaWS\Messages\Components\ComponentInterface;
use EC\EuropaWS\Proxies\ComponentProxyInterface;

/**
 * Class DateMetadataProxy.
 *
 * It defines the mechanism for parsing DateMetadata into a format that is
 * JSON convertible.
 * It works with the Dynamic schema of the Europa Search services.
 *
 * @package EC\EuropaSearch\Proxies\Index\DocumentMetadata
 */
class DateMetadataProxy implements ComponentProxyInterface
{

    /**
     * Converts a metadata in a JSON compatible format.
     *
     * @param ComponentInterface $metadata
     *   DateMetadata to convert.
     * @return array
     *   The metadata in a JSON compatible format.
     */
    public function convertComponent(ComponentInterface $metadata)
    {
        $values = $metadata->getValues();
        $name = $metadata->getEuropaSearchName();

        $values = $this->getMetadataDateValue($values);

        if (count($values) <= 1) {
            $values = reset($values);
        }

        return array($name => $values);
    }

    /**
     *  Gets the date metadata values consumable by Europa Search service.
     *
     * @param array $values
     *   The raw date value to convert.
     * @return array $finalValues
     *   The converted date values.
     */
    private function getMetadataDateValue($values)
    {
        $finalValues = array();
        foreach ($values as $item) {
            $dateTime = new \DateTime($item);
            $finalValues[] = $dateTime->format(\DateTime::ISO8601);
        }

        return $finalValues;
    }
}
