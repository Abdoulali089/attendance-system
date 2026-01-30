<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Create Departments
        $departments = \App\Models\Department::factory(5)->create();

        // 3. Create Employees
        // We'll create 20 employees, assigning each to a random department
        $employees = \App\Models\Employee::factory(20)->create([
            'department_id' => fn() => $departments->random()->id,
        ]);

        // 4. Create Attendances
        // For each employee, create 5 attendance records
        $employees->each(function ($employee) {
            \App\Models\Attendance::factory(5)->create([
                'employee_id' => $employee->id,
            ]);
        });
    }
}
