<?php


namespace Webpack\Listener;


use Exception;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Webpack\Config\WebpackOptions;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class WebpackRouteListenerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Get configuration
        $config = $container->get('config');
        // Check for a webpack config
        if (!isset($config['webpack'])) {
            throw new Exception('Missing webpack configuration');
        }
        $webpackOptions = new WebpackOptions($config['webpack']);
        return new WebpackRouteListener($webpackOptions);
    }
}