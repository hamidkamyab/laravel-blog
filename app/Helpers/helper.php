<?php
 function make_slug($string){
    $slug =  preg_replace('/\s+/u','-',trim($string));
    return $slug;
 }
