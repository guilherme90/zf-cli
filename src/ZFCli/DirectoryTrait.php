<?php

namespace ZFCli;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
trait DirectoryTrait
{
    /**
     * @param $continuePath
     * @return bool
     */
    public function createDirectory($continuePath)
    {
        $path = getcwd() . '/' . $continuePath;

        if (! is_dir($path)) {
            return mkdir($path, 0777, true);
        }

        return false;
    }

    /**
     * @see https://stackoverflow.com/questions/3338123/how-do-i-recursively-delete-a-directory-and-its-entire-contents-files-sub-dir
     * @param string $path
     * @return bool
     */
    public function removeDirectoryRecursive($path)
    {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path,
                \RecursiveDirectoryIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileInfo) {
            $todo = ($fileInfo->isDir() ? 'rmdir' : 'unlink');
            $todo($fileInfo->getRealPath());
        }

        return rmdir($path);
    }
}
