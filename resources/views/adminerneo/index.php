<?php
use Adminer\Adminer;
use function resource_path;
use function config;

function create_adminer(): Adminer
{
    $config = config('adminerneo.interface', []);
    
    return new Adminer($config);
}

include resource_path('adminerneo/adminer.php');