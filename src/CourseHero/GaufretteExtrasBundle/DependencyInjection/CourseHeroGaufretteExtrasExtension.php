<?php

namespace CourseHero\GaufretteExtrasBundle\DependencyInjection;

use Knp\Bundle\GaufretteBundle\DependencyInjection\KnpGaufretteExtension;
use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use \Symfony\Component\HttpKernel\DependencyInjection\Extension;
use \Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CourseHeroGaufretteExtrasExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
    }

    public function prepend(ContainerBuilder $container)
    {
        //Load our factories with gaufrette
        //NOTE: these must be in xml format for gaufrette to process them
        $config = array('factories' => array(__DIR__.'/../Resources/config/adapter_factories.xml'));
        $container->prependExtensionConfig("knp_gaufrette", $config);

    }

}
