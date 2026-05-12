<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 1;
    const SUPER_ADMIN = 2;

    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}