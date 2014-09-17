<?php
namespace Sample\ExpressionLanguage\Config;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ChargeConfiguration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $root = $builder->root('charge');

        $root
            ->children()
                ->arrayNode('summer')
                    ->info('夏期')
                    ->isRequired()
                    ->children()
                        ->scalarNode('span')
                            ->info('シーズンの期間')
                            ->isRequired()->end()
                        ->scalarNode('formula')
                            ->info('料金の式')
                            ->isRequired()->end()
                    ->end()
                ->end()
                ->arrayNode('default')
                    ->info('冬期')
                    ->isRequired()
                    ->children()
                        ->scalarNode('span')
                            ->info('シーズンの期間')
                            ->isRequired()->end()
                        ->scalarNode('formula')
                            ->info('料金の式')
                            ->isRequired()->end()
                    ->end()
                ->end()
            ->end()
        ->end()
        ;

        return $builder;
    }
}
