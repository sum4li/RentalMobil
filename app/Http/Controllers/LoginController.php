<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Product;
use App\Customer;
use App\Transaction;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->product = new Product();
        $this->customer = new Customer();
        $this->transaction = new Transaction();
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('backend.component.login');
    }

    public function dashboard(){
        $product = $this->product;
        $customer = $this->customer;
        $transaction  = $this->transaction;
        // $transaction_data = [];
        for($i=1;$i<=12;$i++){
            $lul = $this->transaction->whereMonth('date',sprintf('%02s',$i))->whereYear('date',date('Y'))->get()->count();
            $transaction_data [] = $lul;
        }
        $label = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $chartjs = app()->chartjs
        ->name('transaksi')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($label)
        ->datasets([
            [
                "label" => "Transaksi",
                'backgroundColor' => "rgba(78, 115, 223, 0.05)",
                'borderColor' => "rgba(78, 115, 223, 1)",
                "pointHoverRadius" => "3",
                "pointHitRadius"=> "10",
                "pointBorderWidth"=> "2",
                "pointBorderColor" => "rgba(78, 115, 223, 1)",
                "pointBackgroundColor" => "rgba(78, 115, 223, 1)",
                "pointHoverBackgroundColor" => "rgba(78, 115, 223, 1)",
                "pointHoverBorderColor" => "rgba(78, 115, 223, 1)",
                'data' => $transaction_data,
                // 'data' => [1,2,3,4,5,6,7,8,9,10,11,12],
            ]
        ])
        ->options([]);
        return view('backend.dashboard.index',compact(['product','customer','transaction','chartjs']));
    }

}
