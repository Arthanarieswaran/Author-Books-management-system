<?php
namespace App\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
    use HasFactory, SoftDeletes;

    protected $table    = 'books';
    protected $fillable = [
        'author_id',
        'title',
        'published_year',
        'language',
        'pages',
        'summary',
        'is_available',
    ];

    protected $casts = [
        'published_year' => 'integer',
        'pages'          => 'integer',
        'is_available'   => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
