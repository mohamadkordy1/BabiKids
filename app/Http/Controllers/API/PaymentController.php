<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; // Assuming you have a Payment model

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
        return response()->json($payments);


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
    public function store(Request $request)
    {
     
        // Validate the request data
        $data = $request->validate([
            'amount' => 'required|numeric|min:0',
            'parent_id' => 'required|exists:users,id', // Assuming you have a Child model
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:255', // Assuming payment method is a string

            'status' => 'required|in:paid,pending,failed', // Assuming status can be paid, pending, or failed
        ]);        


        // Create a new payment record
        $payment = Payment::create($data);

        // Return a response
        return response()->json(['message' => 'Payment recorded successfully', 'payment' => $payment], 201);
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
        return response()->json($payment);
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
    public function update(Request $request, string $id)
    {
        
        // Validate the request data
        $data = $request->validate([
            'amount' => 'sometimes|required|numeric|min:0',
            'parent_id' => 'sometimes|required|exists:users,id', // Assuming you have a Child model
            'payment_date' => 'sometimes|required|date',
            'payment_method' => 'sometimes|required|string|max:255', // Assuming payment method is a string
            'status' => 'sometimes|required|in:paid,pending,failed', // Assuming status can be paid, pending, or failed
        ]);

        // Find the payment record
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment record not found'], 404);
        }

        // Update the payment record
        $payment->update($data);

        // Return a response
        return response()->json(['message' => 'Payment updated successfully', 'payment' => $payment]);
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
