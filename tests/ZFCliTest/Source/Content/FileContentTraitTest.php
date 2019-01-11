<?php

namespace ZFCliTest\Source\Content;

use PHPUnit\Framework\TestCase;
use ZFCli\Source\Content\FileContentTrait;
use ZFCli\Source\Validator\Exception\ValidatorException;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
class FileContentTraitTest extends TestCase
{
    use FileContentTrait;

    /**
     * @test
     */
    public function putWhenFileExists()
    {
        $contentFile = <<<CONTENT
<?php

return [
    'modules' => [
        'User',
        'Product'
    ]
];
CONTENT;

        $put = $this->putFileContent(getcwd() . '/tests/files/config/application.config.php', $contentFile);

        static::assertInternalType('int', $put);
    }

    /**
     * @depends putWhenFileExists
     * @test
     */
    public function getWhenFileExists()
    {
        $get = $this->getFileContent(getcwd() . '/tests/files/config/application.config.php');

        $contentFile = <<<CONTENT
<?php

return [
    'modules' => [
        'User',
        'Product'
    ]
];
CONTENT;

        static::assertSame($contentFile, $get);
    }

    /**
     * @test
     */
    public function getWhenFileDoesNotExists()
    {
        static::expectException(ValidatorException::class);
        static::expectExceptionMessage(
            sprintf('File "%s" does not exists.', getcwd() . '/tests/files/config/file.php')
        );

        $this->getFileContent(getcwd() . '/tests/files/config/file.php');
    }
}
