<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Resources\Menu\MenuResource;
use App\Models\Menu;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Menu::class, 'menu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['menus' => MenuResource::collection(Menu::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMenuRequest $request
     * @return JsonResponse
     */
    public function store(StoreMenuRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $menu = new Menu();
        $menu = $menu->create($validated);
        if (isset($validated['post'])) {
            $menu->post()->associate($validated['post'])->save();
        }
        if (isset($validated['page'])) {
            $menu->page()->associate($validated['page'])->save();
        }

        return $this->Success('Menu has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return JsonResponse
     */
    public function show(Menu $menu): JsonResponse
    {
        return $this->Data(['menu' => new MenuResource($menu)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMenuRequest $request
     * @param Menu $menu
     * @return JsonResponse
     */
    public function update(UpdateMenuRequest $request, Menu $menu): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $menu->update($validated);
        $menu->post()->dissociate();
        if (isset($validated['post'])) {
            $menu->post()->associate($validated['post'])->save();
        }
        $menu->page()->dissociate();
        if (isset($validated['page'])) {
            $menu->page()->associate($validated['page'])->save();
        }

        return $this->Success('Menu has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return JsonResponse
     */
    public function destroy(Menu $menu): JsonResponse
    {

        $menu->delete();
        return $this->Success('Menu has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Menu::class);
        return $this->Data(['menus' => MenuResource::collection(Menu::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Menu $trashed_menu
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_menu): JsonResponse
    {
        $this->authorize('restore', $trashed_menu);
        $trashed_menu = Menu::onlyTrashed()->findOrFail($trashed_menu);
        $trashed_menu->restore();
        return $this->Success('Menu has been Restored Successfully');
    }
}
