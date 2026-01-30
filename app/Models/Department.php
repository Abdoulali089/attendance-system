<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'description'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function workSchedule()
    {
        return $this->hasOne(WorkSchedule::class);
    }
}

