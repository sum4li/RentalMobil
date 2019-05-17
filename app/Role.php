<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Role extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'roles';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug'];
    public $incrementing = false;

}
