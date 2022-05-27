<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['posts' => PostResource::collection(Post::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $post = new Post();
        $post = $post->create($validated);
        if (isset($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return $this->Success('Post has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return $this->Data(['post' => new PostResource($post)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $post->update($validated);
        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return $this->Success('Post has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->tags()->detach();
        $post->menus()->delete();
        $post->delete();
        return $this->Success('Post has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Post::class);
        return $this->Data(['posts' => PostResource::collection(Post::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Post $trashed_post
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_post): JsonResponse
    {
        $this->authorize('restore', $trashed_post);
        $trashed_post = Post::onlyTrashed()->findOrFail($trashed_post);
        $trashed_post->restore();
        return $this->Success('Post has been Restored Successfully');
    }
}
