<?php

/**
 * Contains
 * EC\EuropaWS\Messages\RequestInterface.
 */

namespace EC\EuropaWS\Messages;

/**
 * Class RequestInterface.
 *
 * Implementing it allows objects to instantiated web service request content.
 *
 * @package EC\EuropaWS\Messages
 */
interface RequestInterface
{

    /**
     * Add to the Request object the converted message components.
     *
     * @param array $components
     *   The list of converted components.
     */
    public function addConvertedComponents(array $components);
}
