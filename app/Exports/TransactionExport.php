<?php

namespace App\Exports;

use App\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;

// class TransactionExport implements FromCollection, WithMapping, WithHeadings
class TransactionExport implements FromView
{
    private $from,$to;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function setDate($from,$to){
        $this->from = $from.' 00:00:00';
        $this->to = $to.' 23:59:59';
    }


    public function view(): View
    {
        return view('backend.transaction.export', [
            'transaction' => $this->transaction->where('status','selesai')->whereBetween('created_at',[$this->from,$this->to])->get()
        ]);
    }

    // public function map($transaction): array
    // {
    //     return [
    //         $transaction->invoice_no,
    //         Carbon::parse($transaction->date)->format('Y-m-d'),
    //         Carbon::parse($transaction->date)->format('H:i:s'),
    //         $transaction->customer->name,
    //         $transaction->amount,
    //         $transaction->status
    //     ];
    // }

    // public function headings(): array{
    //     return [
    //         ['Invoice', 'Tanggal','Waktu','Pelanggan','Total','Status']
    //     ];
    // }
}
