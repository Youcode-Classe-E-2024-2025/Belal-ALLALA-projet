<?php
function dd($value)
{
   echo '<pre>';
   var_dump($value);
   echo '</pre>';
   die();
}

function checkURL($value)
{
   $path = parse_url($_SERVER['REQUEST_URI'])['path'];
   return $value === $path;
}
