<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Controllers\Controller;
use App\Models\TravelPackage;
use App\Models\User;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TravelPackage $travelPackage, User $user) : View
    {
        $users = [];
        $tourNames = [];
        
        $reviews = Review::get();

        foreach ($reviews as $review) {
            $user = User::find($review->user_id);
            $users[] = $user;
            $tourName = TravelPackage::find($review->travel_package_id);
            $tourNames[] = $tourName;
        }

        return view('admin.reviews.index')->with(compact('reviews', 'users', 'tourNames'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $review = new Review();
        $review->user_id = $data["user_id"];
        $review->travel_package_id = $data["travel_package_id"];
        $review->rating = $data["rating"];
        $review->comment = $data["comment"];

        $review->save();

        return redirect()->back()->with('message', 'Đánh giá thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
