<?php

if(!function_exists('greetings')) {function greetings() {
   $greetings="";$time=date("H");$timezone=date("e");if($time<"12"){$greetings="pagi";}elseif($time>="12"&&$time<"15"){$greetings="siang";}elseif($time>="17"&&$time<"18"){$greetings="sore";}elseif($time>="18"){$greetings="malam";}return$greetings;
}}

if(!function_exists('findKey')) {function findKey($arr, $code) {
   foreach($arr as $value){if($value->code==$code){return $value->value;}}return NULL;
}}
