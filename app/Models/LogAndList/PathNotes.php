<?php

namespace App\Models\LogAndList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PathNotes extends Model
{
    use SoftDeletes;
    
    protected $connection = 'logandlist';

    protected $fillable = [
        'id',
        'title',
        'content_ko',
        'content_ja',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
