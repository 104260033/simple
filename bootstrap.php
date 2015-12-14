<?php
use Illuminate\Database\Capsule\Manager as Capsule;

define('BASE_PATH',__DIR__);

//Composer Autoload
require "../vendor/autoload.php";

//error pages
$run     = new Whoops\Run;
$run->pushHandler(new Whoops\Handler\PrettyPageHandler);

// Register the handler with PHP, and you're set!
$run->register();


//Eloquent
$capsule = new Capsule;
$capsule->addConnection(require '../config/database.php');
$capsule->bootEloquent();