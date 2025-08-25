<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; // Assuming you have a Payment model
use App\Http\Resources\PaymentResource;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // This method should return a list of payments
        // Assuming you have a Payment model
         $payments = Payment::all();

        // Return the payments as a JSON response
        return PaymentResource::collection($payments);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
     
        

        // Create a new payment record
        $payment = Payment::create($request->validated());

        // Return a response
     return (new PaymentResource($payment))
            ->additional(['message' => 'payments created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment record not found'], 404);
        }

        // Return the payment as a JSON response
          return new PaymentResource($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, string $id)
    {
        
       

        // Find the payment record
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment record not found'], 404);
        }

        // Update the payment record
        $payment->update($request->validated());

        // Return a response
         return (new PaymentResource($payment))
            ->additional(['message' => 'payment updated successfully']);     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the payment record
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment record not found'], 404);
        }

        // Delete the payment record
        $payment->delete();

        // Return a response
        return response()->json(['message' => 'Payment deleted successfully'], 200);
    }
}
