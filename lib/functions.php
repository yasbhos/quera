<?php

function include_all_php_files($dir): void
{
    foreach (glob("$dir/*.php") as $filename) {
        include_once("$filename");
    }
}