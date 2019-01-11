<?php

namespace ZFCliTest\Source\Validator;

use PHPUnit\Framework\TestCase;
use ZFCli\Source\Validator\Exception\ValidatorException;
use ZFCli\Source\Validator\ValidatorsTrait;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
class ValidatorsTraitTest extends TestCase
{
    use ValidatorsTrait;

    /**
     * @var string
     */
    private $path;

    protected function setUp()
    {
        $this->path = getcwd();

        if (is_dir($this->path . '/tests/module/User')) {
            rmdir($this->path . '/tests/module/User');
        }

        if (is_dir($this->path . '/tests/module')) {
            rmdir($this->path . '/tests/module');
        }

        if (file_exists($this->path . '/tests/files/config/application.config.php')) {
            unlink($this->path . '/tests/files/config/application.config.php');
        }
    }

    /**
     * @test
     */
    public function moduleNameIsExists()
    {
        $moduleName = 'User';

        mkdir($this->path . '/tests/module', 0777, true);
        mkdir($this->path . '/tests/module/' . $moduleName, 0777, true);

        static::expectException(ValidatorException::class);
        static::expectExceptionMessage(
            sprintf('Module "%s" already exists.', $this->path . '/tests/module/' . $moduleName)
        );

        $this->moduleExists($this->path . '/tests/module/' . $moduleName);
    }

    /**
     * @test
     */
    public function moduleNameDoesNotExists()
    {
        $moduleName = 'User';

        static::assertFalse($this->moduleExists($this->path . '/tests/module/' . $moduleName));
    }

    /**
     * @test
     */
    public function pathIsExists()
    {
        mkdir($this->path . '/tests/module', 0777, true);

        static::assertTrue($this->isDirectory($this->path . '/tests/module'));
    }

    /**
     * @test
     */
    public function pathDoesNotExists()
    {
        static::expectException(ValidatorException::class);
        static::expectExceptionMessage(
            sprintf('Directory "%s" does not exists.', $this->path . '/tests/module')
        );

        $this->isDirectory($this->path . '/tests/module');
    }

    /**
     * @test
     */
    public function applicationFileDoesNotExists()
    {
        static::expectException(ValidatorException::class);
        static::expectExceptionMessage(
            sprintf('File "%s" does not exists.', $this->path . '/tests/files/config/application.config.php')
        );

        $this->isFile($this->path . '/tests/files/config/application.config.php');
    }

    protected function tearDown()
    {
        $file = <<<FILE
<?php

return [
    'modules' => []
];

FILE;

        file_put_contents($this->path . '/tests/files/config/application.config.php', $file);
    }
}
