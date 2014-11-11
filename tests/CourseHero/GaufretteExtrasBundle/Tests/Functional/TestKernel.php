<?php

namespace CourseHero\GaufretteExtrasBundle\Tests\Functional;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    public function getRootDir()
    {
        return __DIR__.'/Resources';
    }

    public function registerBundles()
    {
        return array(
            new \Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new \CourseHero\GaufretteExtrasBundle\CourseHeroGaufretteExtrasBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/Resources/config/config_'.$this->getEnvironment().'.yml');
    }
}
