<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FileUploadsHelper extends Model
{
    use HasFactory;

    protected $table = 'file_uploads_helper';
    protected $primaryKey = 'id';
    protected static $modelNameCanonical = 'Document Master';
    protected static $modelNameSlug = 'file_uploads_helper';

    // Setup fillable params.
    protected $fillable = [
        'model_id',
        'user_id',
        'model_type',
    ];

    // Set up a one to many inverse relationship with the users table.
    public function user_details()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User', 'user_id', 'id');
    }

    public function getFileInformation($table_name) {
        return DB::table($table_name)
        ->join("{$this->table}", "{$this->table}.model_id", '=', 'orders.user_id')
        ->where("{$this->table}.model_type",$table_name)
        ->select("$table_name.*")
        ->get();
    }
}
