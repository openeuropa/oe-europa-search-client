<?php

/**
 * @file
 * Contains EC\EuropaWS\Proxies\ProxyControllerInterface.
 */

namespace EC\EuropaWS\Proxies;

use EC\EuropaWS\Common\WSConfigurationInterface;
use EC\EuropaWS\Exceptions\ClientInstantiationException;
use EC\EuropaWS\Exceptions\ConnectionException;
use EC\EuropaWS\Exceptions\ProxyException;
use EC\EuropaWS\Messages\Components\ComponentInterface;
use EC\EuropaWS\Messages\MessageInterface;
use EC\EuropaWS\Messages\ValidatableMessageInterface;
use EC\EuropaWS\Transporters\TransporterInterface;

/**
 * Interface ProxyControllerInterface.
 *
 * Implementing this interface allows objects to control the conversion of a Message to send
 * the web service into a format usable by it and call the transporter
 * implementation for sending the result.
 *
 * @package EC\EuropaWS\Proxies
 *
 * @package EC\EuropaWS\Proxies
 */
interface ProxyControllerInterface
{

    /**
     * Converts the message.
     *
     * @param ValidatableMessageInterface $message
     *   The message to convert.
     *
     * @return mixed
     *   The converted message.
     *
     * @throws ProxyException
     *   Raised if a problem occurred during the conversion process.
     */
    public function convertMessage(ValidatableMessageInterface $message);

    /**
     * Converts the message and integrate their converted components in it.
     *
     * @param ValidatableMessageInterface $message
     *   The message to convert.
     * @param array                       $convertedComponent
     *   The list of converted message components to integrate.
     *
     * @return mixed
     *   The converted message.
     *
     * @throws ProxyException
     *   Raised if a problem occurred during the conversion process.
     */
    public function convertMessageWithComponents(ValidatableMessageInterface $message, array $convertedComponent);

    /**
     * Converts a list of components.
     *
     * @param array $components
     *   The components to convert.
     *
     * @return array
     *   Array of the converted components or an empty one if the submitted
     *   list is empty.
     *
     * @throws ProxyException
     *   Raised if a problem occurred during the conversion process.
     */
    public function convertComponents(array $components);

    /**
     * Converts a component.
     *
     * @param ComponentInterface $component
     *   The component to convert.
     *
     * @return mixed
     *   The converted component.
     *
     * @throws ClientInstantiationException
     *   Raised if the process failed because of the client instantiation problem.
     * @throws ProxyException
     *   Raised if a problem occured during the conversion process.
     */
    public function convertComponent(ComponentInterface $component);

    /**
     * Sends the request to teh web service via the Transporter layer.
     *
     * @param MessageInterface     $message
     *   The message to send.
     * @param TransporterInterface $transporter
     *   The transporter in charge of the actual sending.
     *
     * @return MessageInterface
     *   The response from the service.
     *
     * @throws ConnectionException
     *   Raised if a connection problem occurred with the web service.
     * @throws WebServiceErrorException
     *   Raised if a problem occurred with the web service call. That can be an
     *   HTTP error or an error returned by the webd service itself.
     */
    public function sendRequest(MessageInterface $message, TransporterInterface $transporter);

    /**
     * Initializes the HTTP client configuration.
     *
     * @param WSConfigurationInterface $configuration
     *   The web service configuration for the initialization.
     */
    public function initProxy(WSConfigurationInterface $configuration);
}
