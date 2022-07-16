<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Lib\Extensions;

class FileUploads extends Model
{
    use HasFactory, Extensions;

    protected $table = 'file_uploads';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Document';
    protected static $modelNameSlug = 'file_uploads';

    // Setup fillable params.
    protected $fillable = [
        'label',
        'abstract',
        'path',
        'user_id',
    ];

    // Set up a one to many inverse relationship with the users table.
    public function user_details()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User', 'user_id', 'id');
    }
}
