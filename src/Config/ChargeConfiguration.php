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
        $root = $builder->root('seasons');

        $root
            ->useAttributeAsKey('season')
            ->validate()
                ->ifTrue(
                    function ($value) {
                        $keys = array_keys($value);
                        foreach ($keys as $season) {
                            // memo: 連想配列キーの妥当性チェックはsymfony/config組み込みのメソッドではできないのかな？
                            // memo: nodeArray cf. prototype array。
                            if(in_array($season, ['normal', 'summer']) === false) {
                                return true;
                            };
                        }
                        return false;
                })
                ->thenInvalid('Invalid season "%s"')
            ->end()
            ->prototype('array')
                ->children()
                    ->scalarNode('span')
                        ->info('シーズンの期間')
                        ->isRequired()
                        ->end()
                    ->scalarNode('formula')
                        ->info('料金の計算式')
                        ->isRequired()
                        ->end()
            ;

        return $builder;
    }
}
