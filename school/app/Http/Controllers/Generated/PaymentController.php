<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Payment\UpdatePaymentRequest;
use App\Http\Requests\Generated\Payment\StorePaymentRequest;
use App\Http\Resources\Generated\PaymentResource;
use App\Models\Generated\Payment;
use App\Models\Generated\StudentRegistration;
use App\Models\Student;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Payment::class, 'payment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['payments' => PaymentResource::collection(Payment::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePaymentRequest $request
     * @return JsonResponse
     */
    public function store(StorePaymentRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $Student = Student::findOrFail($validated['student_id']);
        if ($Student->latest_student_registration()->debt() < intval($validated['value']))
            return $this->Error('You try to pay more than this student registration debt');
        $payment = new Payment();
        $payment->value = $validated['value'];
        $payment->student_registration_id = $Student->latest_student_registration()->id;
        $payment->save();
        return $this->Success('Payment has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Payment $payment
     * @return JsonResponse
     */
    public function show(Payment $payment): JsonResponse
    {
        return $this->Data(['payment' => new PaymentResource($payment)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePaymentRequest $request
     * @param Payment $payment
     * @return JsonResponse
     */
    public function update(UpdatePaymentRequest $request, Payment $payment): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $payment->update($validated);
        $payment->StudentRegistration()->dissociate();
        if (isset($validated['StudentRegistration'])) {
            $payment->StudentRegistration()->associate($validated['StudentRegistration'])->save();
        }

        return $this->Success('Payment has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Payment $payment
     * @return JsonResponse
     */
    public function destroy(Payment $payment): JsonResponse
    {

        $payment->delete();
        return $this->Success('Payment has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Payment::class);
        return $this->Data(['payments' => PaymentResource::collection(Payment::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Payment $trashed_payment
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_payment): JsonResponse
    {
        $this->authorize('restore', $trashed_payment);
        $trashed_payment = Payment::onlyTrashed()->findOrFail($trashed_payment);
        $trashed_payment->restore();
        return $this->Success('Payment has been Restored Successfully');
    }
}
