<?php

/**
 * @file
 * Contains EC\EuropaSearch\Messages\DocumentMetadata\StringMetadata.
 */

namespace EC\EuropaSearch\Messages\DocumentMetadata;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class StringMetadata.
 *
 * Object for a string metadata of an indexed document.
 *
 * @package EC\EuropaSearch\Messages\DocumentMetadata
 */
class StringMetadata extends AbstractMetadata implements IndexableMetadataInterface
{

    /**
     * StringMetadata constructor.
     *
     * @param string $name
     *   The raw name of the metadata.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public static function getConstraints(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('values', new Assert\All(['constraints' => [new Assert\Type('string')]]));
    }
    /**
     * {@inheritdoc}
     */
    public function getEuropaSearchName()
    {
        return 'esST_'.$this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getConverterIdentifier()
    {
        return self::CONVERTER_NAME_PREFIX.'string';
    }
}
