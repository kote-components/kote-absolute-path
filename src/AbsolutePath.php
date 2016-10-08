<?php

namespace Nerd\Utils\AbsolutePath;

/**
 * @param string $current
 * @param string $to
 * @return string
 */
function go($current, $to)
{
    $trimmed = trim($to, DIRECTORY_SEPARATOR);
    $parts = explode(DIRECTORY_SEPARATOR, $trimmed);
    $step = function ($current, $next) use (&$iter) {
        if ($next == '.' || $next == '') {
            return $current;
        }
        if ($next == '..') {
            return pathinfo($current, PATHINFO_DIRNAME);
        }
        return rtrim($current, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $next;
    };
    return array_reduce($parts, $step, $current);
}

/**
 * Make function that converts relative paths to absolute paths.
 *
 * @param string $absoluteRootPath
 * @return \Closure ($relativePath: string) -> absolutePath: string
 * @throws \Exception
 */
function pathMaker($absoluteRootPath)
{
    $isAbsolutePath = function ($location) {
        return strlen($location) > 0 && $location[0] == '/';
    };

    if (!$isAbsolutePath($absoluteRootPath)) {
        throw new \Exception("Path '$absoluteRootPath' is not absolute, but must.");
    }

    return function ($path) use ($absoluteRootPath) {
        return go($absoluteRootPath, $path);
    };
}
