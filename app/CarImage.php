<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class CarImage extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'car_images';
    protected $dates = ['deleted_at'];
    protected $fillable = ['car_id','image'];
    public $incrementing = false;

    public function car()
    {
        return $this->belongsTo('App\Car');
    }

}
