<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class TagController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tag::class, 'tag');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['tags' => TagResource::collection(Tag::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTagRequest $request
     * @return JsonResponse
     */
    public function store(StoreTagRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $tag = new Tag();
        $tag=$tag->create($validated);

        return $this->Success('Tag has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function show(Tag $tag): JsonResponse
    {
        return $this->Data(['tag' => new TagResource($tag)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTagRequest $request
     * @param Tag $tag
     * @return JsonResponse
     */
    public function update(UpdateTagRequest $request, Tag $tag): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $tag->update($validated);

        return $this->Success('Tag has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function destroy(Tag $tag): JsonResponse
    {
$tag->posts()->detach();
$tag->pages()->detach();

        $tag->delete();
        return $this->Success('Tag has been destroyed successfully');
    }
    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Tag::class);
        return $this->Data(['tags' => TagResource::collection(Tag::onlyTrashed()->get())]);
    }
    /**
     * Update role resource in storage.
     *
     * @param Tag $trashed_tag
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_tag): JsonResponse
    {
        $this->authorize('restore', $trashed_tag);
        $trashed_tag = Tag::onlyTrashed()->findOrFail($trashed_tag);
        $trashed_tag->restore();
        return $this->Success('Tag has been Restored Successfully');
    }
}
