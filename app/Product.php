<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Product extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'products';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug','price'];
    public $incrementing = false;
}
