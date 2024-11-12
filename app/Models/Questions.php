<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $primaryKey = 'question_id';

    protected $fillable = [
        'user_id',
        'username',
        'title',
        'description',
        'content_id', // Foreign key linking to content table
    ];

    // Define the relationship with the Content model
    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'content_id');
    }
}
