<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Message\UpdateMessageRequest;
use App\Http\Requests\Generated\Message\StoreMessageRequest;
use App\Http\Resources\Generated\MessageResource;
use App\Models\Generated\Message;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Message::class, 'message');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['messages' => MessageResource::collection(Message::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessageRequest $request
     * @return JsonResponse
     */
    public function store(StoreMessageRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $message = new Message();
        $message=$message->create($validated);
        if(isset($validated['Student'])){$message->Student()->associate($validated['Student'])->save();}
if(isset($validated['Teacher'])){$message->Teacher()->associate($validated['Teacher'])->save();}
if(isset($validated['SubjectRegistration'])){$message->SubjectRegistration()->associate($validated['SubjectRegistration'])->save();}

        return $this->Success('Message has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Message $message
     * @return JsonResponse
     */
    public function show(Message $message): JsonResponse
    {
        return $this->Data(['message' => new MessageResource($message)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMessageRequest $request
     * @param Message $message
     * @return JsonResponse
     */
    public function update(UpdateMessageRequest $request, Message $message): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $message->update($validated);
        $message->Student()->dissociate();
if(isset($validated['Student'])){$message->Student()->associate($validated['Student'])->save();}
$message->Teacher()->dissociate();
if(isset($validated['Teacher'])){$message->Teacher()->associate($validated['Teacher'])->save();}
$message->SubjectRegistration()->dissociate();
if(isset($validated['SubjectRegistration'])){$message->SubjectRegistration()->associate($validated['SubjectRegistration'])->save();}

        return $this->Success('Message has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return JsonResponse
     */
    public function destroy(Message $message): JsonResponse
    {

        $message->delete();
        return $this->Success('Message has been destroyed successfully');
    }
    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Message::class);
        return $this->Data(['messages' => MessageResource::collection(Message::onlyTrashed()->get())]);
    }
    /**
     * Update role resource in storage.
     *
     * @param Message $trashed_message
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_message): JsonResponse
    {
        $this->authorize('restore', $trashed_message);
        $trashed_message = Message::onlyTrashed()->findOrFail($trashed_message);
        $trashed_message->restore();
        return $this->Success('Message has been Restored Successfully');
    }
}
