<?php

/**
 * @file
 * Contains EC\EuropaWS\Tests\AbstractEuropaSearchTest.
 */

namespace EC\EuropaSearch\Tests;

use EC\EuropaSearch\EuropaSearch;
use EC\EuropaSearch\EuropaSearchConfig;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class AbstractEuropaSearchTest.
 *
 * Centralizes all methods shared between test cases.
 *
 * @package EC\EuropaWS\Tests
 */
abstract class AbstractEuropaSearchTest extends TestCase
{

    /**
     * Gets a dummy service configuration for test purpose.
     *
     * @return EuropaSearchConfig
     *   The dummy service configuration.
     */
    protected function getDummyConfig()
    {
        $wsSettings = [
            'URLRoot' => 'https://intragate.acceptance.ec.europa.eu',
            'APIKey' => 'a221108a-180d-HTTP-CLIENT-LIBRARY-TEST',
            'database' => 'EC-EUROPA-DUMMY',
        ];

        return new EuropaSearchConfig($wsSettings);
    }
    /**
     * Gets the client factory for tests.
     *
     * @return EuropaSearch
     *   The client factory.
     */
    protected function getFactory()
    {

        $config = $this->getDummyConfig();
        $container = new EuropaSearch($config);

        return $container;
    }

    /**
     * Gets the ContainerBuilder used by unit tests.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder
     *   The ContainerBuilder implementation
     */
    protected function getContainer()
    {

        $factory = $this->getFactory();

        return $factory->getClientContainer();
    }

    /**
     * Gets the default validator
     */
    protected function getDefaultValidator()
    {
        return $this->getFactory()->getDefaultValidator();
    }

    /**
     * Gets the validation error messages
     *
     * @param \Symfony\Component\Validator\ConstraintViolationListInterface $violations
     *    Object containing the validation error messages
     *
     * @return array
     *    The list of validation error messages;
     */
    protected function getViolations(ConstraintViolationListInterface $violations)
    {

        $collection = [];
        foreach ($violations as $violation) {
            $collection[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $collection;
    }
}
