<?php

/**
 * @file
 * Contains EC\EuropaSearch\Proxies\Search\SearchProxyController.
 */

namespace EC\EuropaSearch\Proxies\Search;

use EC\EuropaSearch\Messages\Search\Filters\Queries\FilterQueryInterface;
use EC\EuropaWS\Messages\Components\ComponentInterface;
use EC\EuropaWS\Proxies\BasicProxyController;
use EC\EuropaWS\Exceptions\ClientInstantiationException;
use EC\EuropaWS\Exceptions\ProxyException;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class SearchProxyController.
 *
 * ProxyController in charge of the Search process.
 *
 * @package EC\EuropaSearch\Proxies\Search
 */
class SearchProxyController extends BasicProxyController
{

    /**
     * {@inheritDoc}
     */
    public function convertComponent(ComponentInterface $component)
    {

        if ($component instanceof FilterQueryInterface) {
            return $this->convertFilterQueryWithChildren($component);
        }

        return parent::convertComponent($component);
    }

    /**
     * Converts a FilterQueryInterface component with its child components.
     *
     * @param FilterQueryInterface $query
     *   The component to convert.
     *
     * @return mixed
     *   The converted component.
     *
     * @throws ClientInstantiationException
     *   Raised if the process failed because of the client instantiation problem.
     * @throws ProxyException
     *   Raised if a problem occurred during the conversion process.
     */
    public function convertFilterQueryWithChildren(FilterQueryInterface $query)
    {

        try {
            $converterId = $query->getConverterIdentifier();
            $converter = $this->container->get($converterId);
            $children = $query->getChildComponents();

            $convertedComponents = [];
            if (empty($convertedComponents) && !empty($children)) {
                $convertedComponents = $this->convertComponents($children);
            }
            $convertedComponent = $converter->convertComponentWithChildren($query, $convertedComponents);

            return $convertedComponent;
        } catch (ServiceCircularReferenceException $scre) {
            throw new ClientInstantiationException(
                'The conversion of the component failed because of client implementation problem!',
                $scre
            );
        } catch (ServiceNotFoundException $snfe) {
            throw new ClientInstantiationException(
                'The converter for the component has not been found!',
                $snfe
            );
        } catch (\Exception $e) {
            throw new ProxyException(
                'The conversion process of the component failed!',
                $e
            );
        }
    }
}
