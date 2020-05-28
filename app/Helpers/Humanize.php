<?php

if (!function_exists("humanize")) {
    function humanize(string $timestamp){
        return \Carbon\Carbon::parse($timestamp)->diffForHumans();
    }
}
