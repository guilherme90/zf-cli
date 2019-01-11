<?php

namespace ZFCli\Source\Content;

use ZFCli\Source\Validator\ValidatorsTrait;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
trait FileContentTrait
{
    use ValidatorsTrait;

    /**
     * @param string $filename
     * @param string $content
     *
     * @return bool|int
     */
    public function putFileContent($filename, $content)
    {
        return file_put_contents($filename, $content);
    }

    /**
     * @param $filename
     *
     * @return bool|string
     */
    public function getFileContent($filename)
    {
        $this->isFile($filename);

        return file_get_contents($filename);
    }
}
