<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment; // Assuming you have a Payment model
use App\Http\Resources\PaymentResource;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;

class PaymentController extends Controller
{
    public $paymentRepository;
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
       
 return PaymentResource::collection($this->paymentRepository->all());
        
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = $this->paymentRepository->create($request->validated());

        // Return a response
  return (new PaymentResource($payment))
            ->additional(['message' => 'payment created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = $this->paymentRepository->find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
        $Payment = Payment::find($id);
        return new PaymentResource($Payment);
    }

    
    public function update(UpdatePaymentRequest $request, string $id)
    {
        $payment = $this->paymentRepository->find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $updatedPayment = $this->paymentRepository->update($id, $request->validated());

        return (new PaymentResource($updatedPayment))
            ->additional(['message' => 'Payment updated successfully'])
            ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = $this->paymentRepository->find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $this->paymentRepository->delete($id);

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
