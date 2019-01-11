<?php

namespace ZFCli\Source\Validator;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
trait ValidatorsTrait
{
    /**
     * @param string $path
     *
     * @return bool
     * @throws Exception\ValidatorException
     */
    public function isDirectory($path)
    {
        if (! is_dir($path)) {
            throw Exception\ValidatorException::directoryNotFound($path);
        }

        return true;
    }

    /**
     * @param string $path
     *
     * @return bool
     * @throws Exception\ValidatorException
     */
    public function moduleExists($path)
    {
        if (is_dir($path)) {
            throw Exception\ValidatorException::fromModuleName($path);
        }

        return false;
    }

    /**
     * @param string $filename
     * @throws Exception\ValidatorException
     */
    public function isFile($filename)
    {
        if (! file_exists($filename)) {
            throw Exception\ValidatorException::fileNotFound($filename);
        }
    }
}
