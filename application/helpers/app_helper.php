<?php

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\VarDumper;

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('time_execution')) {
    function time_execution()
    {
        $CI =& get_instance();
        return $CI->benchmark->elapsed_time();
    }
}

if (!function_exists('debug')) {
    
    function debug($data, $die = false) {
        VarDumper::setHandler(function ($data) {

            $cloner = new VarCloner;

            $htmlDumper = new HtmlDumper;
            $htmlDumper->setStyles([
                'default' => 'background-color:#18171B; color:#FF8400; line-height:1.2em; font:12px Menlo, Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:99999; word-break: break-all',
                'num' => 'font-weight:bold; color:#1299DA',
                'const' => 'font-weight:bold',
                'str' => 'font-weight:bold; color:#6de89e',
                'note' => 'color:#1299DA',
                'ref' => 'color:#A0A0A0',
                'public' => 'color:#FFFFFF',
                'protected' => 'color:#FFFFFF',
                'private' => 'color:#FFFFFF',
                'meta' => 'color:#B729D9',
                'key' => 'color:#6de89e',
                'index' => 'color:#1299DA',
                'ellipsis' => 'color:#FF8400',
            ]);

            $dumper = PHP_SAPI === 'cli' ? new CliDumper : $htmlDumper;

            $dumper->dump($cloner->cloneVar($data));

        });
        dump($data);
        if ($die == true) {
            die(1);
        }
    }

}
