<?php

namespace App\Repositories;
use App\Models\Payment;
class PaymentRepository
{
   
    public function all()
    {
        return Payment::all();
    }

    public function find($id)
    {
        $payment = Payment::find($id);
         if (!$payment) {
            return false;
        }
        return true;
        
    }

    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function update($id, array $data)
    {
        $payment = Payment::findOrFail($id);
        $payment->update($data);
        return $payment;
    }

    public function delete($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return true;
    }
}
