<?php

namespace App\Models\Backend\Meta;

use App\Models\Backend\Lib\Extensions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaAccountToInstruction extends Model
{
    use HasFactory, Extensions, SoftDeletes;

    protected $table = 'meta_account_to_instruction';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Setup fillable params.
    protected $fillable = [
        'from',
        'to',
        'meta',
    ];
}
