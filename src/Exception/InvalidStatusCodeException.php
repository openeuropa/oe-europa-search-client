<?php

declare(strict_types=1);

namespace OpenEuropa\EuropaSearchClient\Exception;

/**
 * Thrown when an API endpoint call returns a status code other than 200.
 */
class InvalidStatusCodeException extends \RuntimeException
{
}
