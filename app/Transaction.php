<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Transaction extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'transactions';
    protected $dates = ['deleted_at'];
    protected $fillable = ['car_id','customer_id','invoice_no','rent_date','back_date','return_date','price','amount','penalty','status'];
    public $incrementing = false;

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }
}
