<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Customer extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'customers';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug','phone_number','email'];
    public $incrementing = false;
}
