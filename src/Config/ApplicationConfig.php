<?php
namespace Sample\ExpressionLanguage\Config;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderResolver;

class ApplicationConfig
{
    protected $config;
    protected static $configDir;
    protected static $configFileName;

    public function __construct()
    {
        static::$configDir = __DIR__ . '/../../app/config';
        static::$configFileName = 'charge.yml';
        $this->config = $this->loadConfig();
    }

    /**
     * @return mixed
     * @throws \Exception
     * @throws \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    private function loadConfig()
    {
        $configDir = new FileLocator(static::$configDir);

        $loader = new YamlFileLoader($configDir);
        $loaderResolver = new LoaderResolver([$loader]);
        $delegatingLoader = new DelegatingLoader($loaderResolver);

        try {
            $config = $delegatingLoader->load(static::$configFileName);
            //var_dump($config);
            //$dumper = new YamlReferenceDumper();
            //$dumper->dump(new CursorCleanerConfiguration());
        } catch (InvalidConfigurationException $e) {
            echo $e->getMessage() . PHP_EOL;
            throw $e;
        }

        return $config;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }
}
