<?php

namespace ZFCliTest\Filters;

use PHPUnit\Framework\TestCase;
use ZFCli\Filters\WordFormatTrait;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
class WordFormatTraitTest extends TestCase
{
    use WordFormatTrait;

    /**
     * @test
     */
    public function verifyModuleName()
    {
        $moduleName = 'credit-card';

        static::assertSame($moduleName, $this->filterModuleName($moduleName));
        static::assertInternalType('string', $this->filterModuleName($moduleName));
    }

    /**
     * @test
     */
    public function verifyControllerName()
    {
        $expected = 'check-payment';
        $controllerName = $this->filterControllerName($expected. '-controller');

        static::assertSame($expected, $controllerName);
        static::assertInternalType('string', $controllerName);
    }
}
