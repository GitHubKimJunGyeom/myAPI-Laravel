<?php

namespace App\Models\LogAndList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;

    protected $connection = 'logandlist';

    protected $fillable = [
        'user_id',
        'nickname',
        'password_hash',
        'content',
        'page_id',
        'parent_id',
    ];

    // /**
    //  * Login User
    //  */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Parent Comment
     */
    public function parent()
    {
        return $this->belongsTo(Comments::class, 'parent_id');
    }

    /**
     * Children Comments
     */
    public function children()
    {
        return $this->hasMany(Comments::class, 'parent_id');
    }
}
