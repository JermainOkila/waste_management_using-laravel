<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::find(4); // adjust to whichever user's request you dispatched
foreach ($user->notifications as $n) {
    print_r($n->toArray());
}