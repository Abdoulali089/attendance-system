<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating User...\n";
    \App\Models\User::factory()->create();
    echo "User Created.\n";

    echo "Creating Department...\n";
    \App\Models\Department::factory()->create();
    echo "Department Created.\n";

    echo "Creating Employee...\n";
    \App\Models\Employee::factory()->create();
    echo "Employee Created.\n";

    echo "Creating Attendance...\n";
    \App\Models\Attendance::factory()->create();
    echo "Attendance Created.\n";

} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
