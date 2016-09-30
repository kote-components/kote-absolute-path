<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 9/30/16
 * Time: 8:49 AM
 */

namespace Kote\Utils\AbsolutePath;

/**
 * Make function that converts relative paths to absolute paths.
 *
 * @param string $absoluteRootPath
 * @return \Closure ($relativePath: string) -> absolutePath: string
 * @throws \Exception
 */
function absolutePathMaker($absoluteRootPath)
{
    $isRootDir = function ($location) {
        return $location == '/';
    };

    $isAbsolutePath = function ($location) {
        return strlen($location) > 0 && $location[0] == '/';
    };

    if (!$isAbsolutePath($absoluteRootPath)) {
        throw new \Exception("Path '$absoluteRootPath' is not absolute, but must.");
    }

    $step = function ($location, $node) use ($isRootDir) {
        if ($node == '.' || $node == '') {
            return $location;
        }
        if ($node == '..') {
            return $isRootDir($location) ? $location : pathinfo($location, PATHINFO_DIRNAME);
        }
        return $isRootDir($location) ?  $location . $node : $location . DIRECTORY_SEPARATOR . $node;
    };

    return function ($path) use ($isAbsolutePath, $absoluteRootPath, $step) {
        if ($isAbsolutePath($path)) {
            throw new \Exception("Path '$path' is absolute, but must not.");
        }

        $nodes = explode(DIRECTORY_SEPARATOR, $path);

        return array_reduce($nodes, $step, $absoluteRootPath);
    };
}
