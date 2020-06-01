<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 *  DO NOT DELLETE THIS FILE !!! OR YOUR APPLICATION WILL BROKEN
 * 
 * @source https://gist.github.com/komputronika/f92397b4f60870131ef52930faf09983
 * @author @komputronika
 * @link https://gist.github.com/komputronika
 * [functions_in_file get defined function from file]
 * @param  file  $file file contains function
 * @param  boolean $sort sort function name
 * @return array
 */
function functions_in_file($file, $sort = FALSE) {
    $file = join("\n",file($file));
    preg_match_all('/function\s+(\w+)/', $file, $m);
    $functions = $m[1];
    if ($sort) {
        asort($functions);
    }
    return $functions;
}
