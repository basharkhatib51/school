<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Http\Requests\Page\StorePageRequest;
use App\Http\Resources\Page\PageResource;
use App\Models\Page;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Page::class, 'page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['pages' => PageResource::collection(Page::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePageRequest $request
     * @return JsonResponse
     */
    public function store(StorePageRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $page = new Page();
        $page = $page->create($validated);
        if (isset($validated['tags'])) {
            $page->tags()->attach($validated['tags']);
        }

        return $this->Success('Page has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function show(Page $page): JsonResponse
    {
        return $this->Data(['page' => new PageResource($page)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePageRequest $request
     * @param Page $page
     * @return JsonResponse
     */
    public function update(UpdatePageRequest $request, Page $page): JsonResponse
    {
        $validated = $request->validated();
        $page->update($validated);
        if (isset($validated['tags'])) {
            $page->tags()->sync($validated['tags']);
        }

        return $this->Success('Page has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return JsonResponse
     */
    public function destroy(Page $page): JsonResponse
    {
        $page->tags()->detach();
        $page->menus()->delete();
        $page->delete();
        return $this->Success('Page has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Page::class);
        return $this->Data(['pages' => PageResource::collection(Page::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Page $trashed_page
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_page): JsonResponse
    {
        $this->authorize('restore', $trashed_page);
        $trashed_page = Page::onlyTrashed()->findOrFail($trashed_page);
        $trashed_page->restore();
        return $this->Success('Page has been Restored Successfully');
    }
}
