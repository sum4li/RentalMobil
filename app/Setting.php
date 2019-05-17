<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Setting extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'settings';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id','name','slug','type','description'];
    public $incrementing = false;
}
