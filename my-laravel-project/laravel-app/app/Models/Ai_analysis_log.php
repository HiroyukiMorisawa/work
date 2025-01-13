<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ai_analysis_log extends Model
{
    use HasFactory;
    protected $table = 'ai_analysis_log';
    public $timestamps = false;
    
    protected $fillable = [
        'image_path',
        'success',
        'message',
        "class",
        "confidence",
        "request_timestamp",
        "response_timestamp"
    ];

}
