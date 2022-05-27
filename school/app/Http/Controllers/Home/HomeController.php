<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Menu\MenuResource;
use App\Http\Resources\Page\PageResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{

    public function menu_elements(): \Illuminate\Http\JsonResponse
    {
        return $this->Data(['menu_elements' => MenuResource::collection(Menu::all())]);
    }

    public function contact_us(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        Mail::send('emails.contactForm', ['email' => $validated['email'], 'name' => $validated['name'], 'inquiry' => $validated['message'], 'phone' => $validated['phone']], function ($m) use ($validated){
            $m->from($validated['email'], $validated['name']);
            $m->to('info@school.layouteam.com', 'School')->subject('Contact');
        });
        return $this->Success('thank you for contacting us our team will contact with you soon :)');
    }
    public function posts(): \Illuminate\Http\JsonResponse
    {
        return $this->Data(['posts' => PostResource::collection(Post::all())]);
    }
    public function post(Post $post): \Illuminate\Http\JsonResponse
    {
        return $this->Data(['post' => new PostResource($post)]);
    }
    public function page(Page $page): \Illuminate\Http\JsonResponse
    {
        return $this->Data(['page' => new PageResource($page)]);
    }
}
