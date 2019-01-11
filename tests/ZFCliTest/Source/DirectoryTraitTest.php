<?php

namespace ZFCliTest\Source;

use PHPUnit\Framework\TestCase;
use ZFCli\DirectoryTrait;

/**
 * @author Guilherme Nogueira <guilhermenogueira2univicosa.com.br>
 */
class DirectoryTraitTest extends TestCase
{
    use DirectoryTrait;

    private $path = 'module/User/src/User/Controller';

    /**
     * @test
     */
    public function createdDirectory()
    {
        static::assertTrue($this->createDirectory($this->path));
    }

    /**
     * @test
     */
    public function directoryAlreadyCreated()
    {
        static::assertFalse($this->createDirectory($this->path));
    }

    /**
     * @test
     */
    public function removeDirectory()
    {
        static::assertTrue($this->removeDirectoryRecursive($this->path));
    }

}