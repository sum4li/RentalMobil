<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Car extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'cars';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','manufacture_id','license_number','color','year','status','price','penalty'];
    public $incrementing = false;

    public function manufacture()
    {
        return $this->belongsTo('App\Manufacture');
    }
}
