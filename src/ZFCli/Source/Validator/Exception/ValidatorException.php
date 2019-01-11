<?php

namespace ZFCli\Source\Validator\Exception;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
class ValidatorException extends \Exception
{
    /**
     * @param string $path
     *
     * @return ValidatorException
     */
    public static function directoryNotFound($path)
    {
        return new self(sprintf('Directory "%s" does not exists.', $path));
    }

    /**
     * @param $moduleName
     *
     * @return ValidatorException
     */
    public static function fromModuleName($moduleName)
    {
        return new self(sprintf('Module "%s" already exists.', $moduleName));
    }

    /**
     * @param $filename
     *
     * @return ValidatorException
     */
    public static function fileNotFound($filename)
    {
        return new self(sprintf('File "%s" does not exists.', $filename));
    }
}
