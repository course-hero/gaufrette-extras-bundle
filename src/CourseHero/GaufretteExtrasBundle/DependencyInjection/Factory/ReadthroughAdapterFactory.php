<?php

namespace CourseHero\GaufretteExtrasBundle\DependencyInjection\Factory;

use Knp\Bundle\GaufretteBundle\DependencyInjection\Factory;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

class ReadthroughAdapterFactory implements Factory\AdapterFactoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $container
            ->setDefinition($id, new DefinitionDecorator('course_hero.gaufrette_extras.adapter.readthrough'))
            ->addArgument(new Reference('gaufrette.' . $config['primary'] . '_adapter'))
            ->addArgument(new Reference('gaufrette.' . $config['fallback'] . '_adapter'));
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getKey()
    {
        return 'readthrough';
    }

    /**
     * {@inheritDoc}
     */
    public function addConfiguration(NodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode('primary')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('fallback')->isRequired()->cannotBeEmpty()->end()
            ->end()
        ;
    }
}