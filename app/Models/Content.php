<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    // Define the custom table name
    protected $table = 'content';  // Table name is 'content', not 'contents'

    protected $primaryKey = 'content_id';  // Custom primary key

    protected $fillable = ['content_name'];  // Fields that are mass assignable

    public $timestamps = true;  // Enable timestamps (created_at, updated_at
}
