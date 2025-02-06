<?php
use Adminer\Adminer;

function create_adminer(): Adminer
{
    $config = config('adminerneo.interface', []);
    
    return new Adminer($config);
}

include resource_path('adminerneo/adminer.php');