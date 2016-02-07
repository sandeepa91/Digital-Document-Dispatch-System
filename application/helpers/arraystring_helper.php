<?php
/**
 * Created by IntelliJ IDEA.
 * User: jayaneetha
 * Date: 1/7/16
 * Time: 5:31 PM
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('sub_authors')) {
    function sub_authors($array)
    {
        $text = "";
        foreach ($array as $item) {
            $text = $text . $item->first_name . " " . $item->last_name . ", ";
        }
        $text = substr($text, 0, -2);

        return $text;
    }
}

if (!function_exists('keywords')) {
    function keywords($array)
    {
        $text = "";
        foreach ($array as $item) {
            $text = $text . $item->keyword . ", ";
        }
        $text = substr($text, 0, -2);

        return $text;
    }
}

