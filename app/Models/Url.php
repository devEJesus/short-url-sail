<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tuupola\Base62;

class Url extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the plural form of the model name
    protected $table = 'url';

    // Define the primary key column name
    protected $primaryKey = 'id_url';

    // Specify that the primary key is non-incrementing or a non-integer if needed
    public $incrementing = true;


    // Specify which attributes can be mass-assigned
    protected $fillable = [
        'id_user',
        'long_url',
        'short_url'
    ];

    // Specify which attributes should be cast to native types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id_user');
    }
}
