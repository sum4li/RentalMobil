<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class TransactionDetail extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'transaction_details';
    protected $dates = ['deleted_at'];
    protected $fillable = ['transaction_id','product_id','qty','price','total'];
    public $incrementing = false;

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
