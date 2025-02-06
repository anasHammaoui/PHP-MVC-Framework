<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([

   "driver" => $_ENV["Driver"],

   "host" =>$_ENV["Host"],

   "database" =>$_ENV["DbName"],

   "username" => $_ENV["UserName"],

   "password" => $_ENV["Password"]
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();