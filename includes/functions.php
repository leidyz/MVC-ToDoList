<?php

namespace Includes;

class Path{

     /**
     * Normalize the path by replacing directory separators based on the operating system.
     *
     * @param string $path
     * @return string
     */
    public static function normalizePath($path)
    {
        return str_replace(["\\", "/"], DIRECTORY_SEPARATOR, $path);
    }
}

?>