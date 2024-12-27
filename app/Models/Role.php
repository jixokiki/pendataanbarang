<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Define the table name if it's different from the plural form of the model name
    // protected $table = 'roles'; // Optional if using default table name

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'description', // Add any other attributes you want
    ];

    // If you want to define relationships, you can do that here
    // For example, if a role has many users:
    public function users()
    {
        return $this->hasMany(User::class);
    }
}