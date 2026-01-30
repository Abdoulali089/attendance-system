<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Testing route resolution:\n";
    echo "attendance.check-in: " . route('attendance.check-in') . "\n";
    echo "attendance.check-out: " . route('attendance.check-out') . "\n";
    echo "reports.daily: " . route('reports.daily') . "\n";
    echo "employees.index: " . route('employees.index') . "\n";
    echo "\nAll routes resolved successfully!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
