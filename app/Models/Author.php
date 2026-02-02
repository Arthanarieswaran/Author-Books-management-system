<?php
namespace App\Models;

use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    = 'authors';
    protected $fillable = [
        'name',
        'email',
        'bio',
        'country',
        'is_active',
        'last_published_at',
    ];

    protected $casts = [
        'dob'               => 'date',
        'is_active'         => 'boolean',
        'last_published_at' => 'datetime',
    ];

    public function books()
    {
        return $this->hasMany(Books::class);
    }
}
