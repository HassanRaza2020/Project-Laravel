<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';  // Table name is 'content', not 'contents'

    protected $primaryKey = 'answer_id';  // Custom primary key

    protected $fillable = ['question_id','user_id','Username','Description'];  // Fields that are mass assignable

    public $timestamps = true;  // Enable timestamps (created_at, updated_at

    


}
