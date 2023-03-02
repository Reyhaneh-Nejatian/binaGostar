<?php

namespace arghavan\Payment\Repositories;

use arghavan\Payment\Models\Order;
use arghavan\Payment\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PaymentRepo
{
    private $query;
    public function __construct()
    {
        $this->query = Payment::query();
    }

    public function paginate()
    {
        return $this->query->latest()->paginate(10);
    }

    public function lately()
    {
        return $this->query->latest()->limit(5)->get();
    }

    public function orders()
    {
        return Order::query()->where('payment_status',Order::STATUS_PAID)
            ->latest()->paginate(10);
    }
    public function store($priceFinal,$orderId,$keyOrders,$invoiceId)
    {
        $payment = Payment::create([
            'buyer_id' => auth()->id(),
            'order_id' => $orderId,
            'keyOrders' => $keyOrders,
            'amount' => $priceFinal,
            'invoice_id' => $invoiceId,
            'gateway' => 'zarinpal',
            'status' => Payment::STATUS_PENDING,
        ]);

        return $payment;
    }

    public function findByInvoiceId($invoiceId)
    {
        return Payment::query()->where('invoice_id',$invoiceId)->first();
    }

    public function changeStatus($id, string $status){

        return Payment::query()->whereId($id)->update([
            'status' => $status
        ]);
    }

    public function searchEmail($email)
    {
        if(!is_null($email))
        {
            $this->query->join("users","payments.buyer_id","users.id")
                ->select('payments.*',"users.email")
                ->where("email","like","%".$email."%");
        }

        return $this;
    }

    public function searchAmount($amount)
    {
        if(!is_null($amount))
        {
            $this->query->where('amount',$amount);
        }

        return $this;
    }

    public function searchInvoiceId($invoiceId)
    {
        if(!is_null($invoiceId))
        {
            $this->query->where('invoice_id',"like","%".$invoiceId."%");
        }

        return $this;
    }
    public function searchStatus($status)
    {
        if($status)
            $this->query->where('status',$status);
        return $this;
    }

    public function searchAfterDate($date)
    {
        if(!is_null($date))
        {
            $this->query->whereDate('created_at','>=',$date);
        }
        return $this;
    }

    public function searchBeforeDate($date)
    {
        if(!is_null($date))
        {
            $this->query->whereDate('created_at','<=',$date);
        }
        return $this;
    }

    public function getLastNDaysPayments($status, $days=null)
    {
        $query = Payment::query();
        if(!is_null($days)) $query = $query->where('created_at','>=',now()->addDays($days));
        return $query->where("status",$status)->latest();
    }

    public function getLastNDaysSuccessPayments($days = null)
    {
        return $this->getLastNDaysPayments(Payment::STATUS_SUCCESS,$days);
    }

    public function getLastNDaysTotal($days = null)
    {
        return $this->getLastNDaysSuccessPayments($days)->sum("amount");
    }

    public function getTodaysIncome($days)
    {
        return Payment::query()->where('created_at',$days)
            ->where('status',Payment::STATUS_SUCCESS)
            ->sum('amount');
    }

    public function getNumberSuccessfulTransaction($days)
    {
        return Payment::query()->where('created_at',$days)
            ->where('status',Payment::STATUS_SUCCESS)
            ->count('id');
    }


}


