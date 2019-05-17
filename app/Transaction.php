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
    protected $fillable = ['customer_id','invoice_no','date','amount','status'];
    public $incrementing = false;

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
