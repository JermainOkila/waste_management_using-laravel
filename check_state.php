<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$requests = App\Models\PickupRequest::with('user')->get();
foreach ($requests as $r) {
    echo "ID: {$r->id}, User: {$r->user->name} (user_id={$r->user_id}), Status: {$r->status}\n";
}