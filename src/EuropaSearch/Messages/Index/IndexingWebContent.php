<?php

namespace EC\EuropaSearch\Messages\Index;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class IndexingWebContent.
 *
 * It defines a web content document that is sent for indexing to the Europa Search
 * services.
 *
 * @package EC\EuropaSearch\Messages\Index
 */
class IndexingWebContent extends AbstractIndexingMessage
{

    /**
     * The content of the web content to send for indexing.
     *
     * @var string
     */
    private $documentContent;

    /**
     * Gets the content of the indexed document.
     *
     * @return string
     *    The content of the indexed document.
     */
    public function getDocumentContent()
    {
        return $this->documentContent;
    }

    /**
     * Sets the content of the indexed document.
     *
     * @param string $documentContent
     *    The document content to index.
     */
    public function setDocumentContent($documentContent)
    {
        $this->documentContent = $documentContent;
    }

    /**
     * {@inheritdoc}
     */
    public function getConverterIdentifier()
    {
        return self::CONVERTER_NAME_PREFIX.'webContent';
    }

    /**
     * {@inheritdoc}
     */
    public static function getConstraints(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('documentContent', new Assert\NotBlank());
    }
}
