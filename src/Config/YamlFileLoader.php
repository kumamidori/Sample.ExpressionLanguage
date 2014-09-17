<?php
namespace Sample\ExpressionLanguage\Config;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class YamlFileLoader extends FileLoader
{
    /**
     * Loads a resource.
     *
     * @param mixed $resource The resource
     * @param string $type The resource type
     * @return array The processed configuration
     * @throws \RuntimeException
     */
    public function load($resource, $type = null)
    {
        $path = $this->locator->locate($resource);
        $configValues = $this->loadFile($path);

        if ($configValues === null) {
            return null;
        }
        $processor = new Processor();

        return $processor->processConfiguration(new ChargeConfiguration(), $configValues);
    }

    /**
     * Returns true if this class supports the given resource.
     *
     * @param mixed $resource A resource
     * @param string $type The resource type
     *
     * @return bool    true if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return is_string($resource) &&
                pathinfo($resource, PATHINFO_EXTENSION) === 'yml';
    }

    private function loadFile($path)
    {
        return Yaml::parse($path);
    }
}
