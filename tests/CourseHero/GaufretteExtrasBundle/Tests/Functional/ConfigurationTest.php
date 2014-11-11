<?php

namespace CourseHero\GaufretteExtrasBundle\Tests\Functional;

use Symfony\Component\Filesystem\Filesystem;
use Gaufrette\StreamWrapper;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    private $cacheDir;
    private $kernel;

    public function setUp()
    {
        $this->cacheDir = __DIR__.'/Resources/cache';
        if (file_exists($this->cacheDir)) {
            $filesystem = new Filesystem();
            $filesystem->remove($this->cacheDir);
        }

        mkdir($this->cacheDir, 0777, true);

        $this->kernel = new TestKernel('test', false);
        $this->kernel->boot();
    }

    public function tearDown()
    {
        if (file_exists($this->cacheDir)) {
            $filesystem = new Filesystem();
            $filesystem->remove($this->cacheDir);
        }
    }

    /**
     * @test
     * @functional
     */
    public function shouldAllowForFilesystemAlias()
    {
        $filesystem = $this->kernel->getContainer()->get('foo_filesystem');
        $this->assertInstanceOf('Gaufrette\Filesystem', $filesystem);
        $adapter = $filesystem->getAdapter();
        $this->assertInstanceOf('CourseHero\GaufretteExtras\Adapter\ReadthroughAdapter', $adapter);
    }

}
