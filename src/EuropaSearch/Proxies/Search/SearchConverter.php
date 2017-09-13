<?php

/**
 * @file
 * Contains EC\EuropaSearch\Proxies\Search\SearchConverter.
 */

namespace EC\EuropaSearch\Proxies\Search;

use EC\EuropaSearch\Messages\Search\SearchMessage;
use EC\EuropaSearch\Messages\Search\SearchRequest;
use EC\EuropaWS\Proxies\MessageConverterInterface;
use EC\EuropaWS\Common\WSConfigurationInterface;
use EC\EuropaWS\Exceptions\ProxyException;
use EC\EuropaWS\Messages\ValidatableMessageInterface;

/**
 * Class SearchConverter.
 *
 * Converter for SearchMessage object.
 *
 * @package EC\EuropaSearch\Proxies\Search
 */
class SearchConverter implements MessageConverterInterface
{

    /**
     * {@inheritDoc}
     */
    public function convertMessage(ValidatableMessageInterface $message, WSConfigurationInterface $configuration)
    {
        throw new ProxyException('The "convertMessage()" method is not supported.');
    }

    /**
     * {@inheritDoc}
     */
    public function convertMessageWithComponents(ValidatableMessageInterface $message, array $convertedComponent, WSConfigurationInterface $configuration)
    {

        $request = new SearchRequest();

        $parameter = $message->getSearchedLanguages();
        $request->setLanguages($parameter);

        $parameter = $message->getHighLightLimit();
        $request->setHighlightLimit($parameter);

        $parameter = $message->getHighlightRegex();
        $request->setHighlightRegex($parameter);

        $parameter = $message->getPaginationLocation();
        $request->setPageNumber($parameter);

        $parameter = $message->getPaginationSize();
        $request->setPageSize($parameter);

        $parameter = $message->getSessionToken();
        $request->setSessionToken($parameter);

        // Build the final sort value to send to the service.
        $sort = $message->getSortField();
        if (!empty($sort)) {
            $sortDirection = ($message->getSortDirection()) ?: SearchMessage::SEARCH_SORT_ASC;
            $sort .= ':'.$sortDirection;
            $request->setSort($sort);
        }

        $request->setText($message->getSearchedText());

        if (!empty($convertedComponent)) {
            $injectedComponent = reset($convertedComponent);
            $request->addConvertedComponents($injectedComponent);
        }

        // Data retrieved from the web services configuration.
        $WSSettings = $configuration->getConnectionConfig();
        $request->setAPIKey($WSSettings['APIKey']);

        return $request;
    }
}
