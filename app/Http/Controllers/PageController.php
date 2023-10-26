<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use App\Models\TravelPackage;
use App\Mail\StoreContactMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreEmailRequest;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(): View
    {
        $categories = Category::with('travel_packages')->get();
        $posts = Post::get();

        return view('home', compact('categories', 'posts'));
    }

    public function detail(TravelPackage $travelPackage): View
    {
        $reviews = Review::where('travel_package_id', $travelPackage->id)->get();
        $users = [];

        foreach ($reviews as $review) {
            $user = User::find($review->user_id);
            $users[] = $user;
        }

        return view('detail', compact('travelPackage', 'reviews', 'users'));
    }

    public function package()
    {
        $travelPackages = TravelPackage::with('galleries')->get();

        return view('package', compact('travelPackages'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('query');

        $travelPackages = TravelPackage::with('galleries')
            ->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->get();

        return view('package', compact('travelPackages'));
    }
    public function order()
    {
        $travels = TravelPackage::get();
        $tourId = request()->query('tour_id');

        return view('order', compact('travels', 'tourId'));
    }

    public function change_info()
    {
        return view('changeInfo');
    }

    public function posts()
    {
        $posts = Post::get();

        return view('posts', compact('posts'));
    }

    public function detailPost(Post $post)
    {
        return view('posts-detail', compact('post'));
    }


    public function contact()
    {
        return view('contact');
    }

    public function getEmail(StoreEmailRequest $request)
    {
        $detail = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::to('cmanh0603@gmail.com')->send(new StoreContactMail($detail));
        return back()->with('message', 'Gửi thành công!!');
    }
}