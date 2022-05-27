<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Notification\UpdateNotificationRequest;
use App\Http\Requests\Generated\Notification\StoreNotificationRequest;
use App\Http\Resources\Generated\NotificationResource;
use App\Models\Generated\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Notification::class, 'notification');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['notifications' => NotificationResource::collection(Notification::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNotificationRequest $request
     * @return JsonResponse
     */
    public function store(StoreNotificationRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $notification = new Notification();
        $notification = $notification->create($validated);
        if (isset($validated['class_levels'])) {
            $notification->class_levels()->attach($validated['class_levels']);
        }
        if (isset($validated['classroom'])) {
            $notification->classroom()->associate($validated['classroom'])->save();
        }

        return $this->Success('Notification has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Notification $notification
     * @return JsonResponse
     */
    public function show(Notification $notification): JsonResponse
    {
        return $this->Data(['notification' => new NotificationResource($notification)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNotificationRequest $request
     * @param Notification $notification
     * @return JsonResponse
     */
    public function update(UpdateNotificationRequest $request, Notification $notification): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $notification->update($validated);
        if (isset($validated['class_levels'])) {
            $notification->class_levels()->sync($validated['class_levels']);
        }
        $notification->Classroom()->dissociate();
        if (isset($validated['Classroom'])) {
            $notification->Classroom()->associate($validated['Classroom'])->save();
        }

        return $this->Success('Notification has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Notification $notification
     * @return JsonResponse
     */
    public function destroy(Notification $notification): JsonResponse
    {
        $notification->class_levels()->detach();

        $notification->delete();
        return $this->Success('Notification has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Notification::class);
        return $this->Data(['notifications' => NotificationResource::collection(Notification::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Notification $trashed_notification
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_notification): JsonResponse
    {
        $this->authorize('restore', $trashed_notification);
        $trashed_notification = Notification::onlyTrashed()->findOrFail($trashed_notification);
        $trashed_notification->restore();
        return $this->Success('Notification has been Restored Successfully');
    }
}
