<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public $countries = [
        'United States of America',
        'Ireland',
        'United Kingdom',
        'France',
        'Germany',
        'Spain',
        'Portugal',
        'Canada'
    ];

     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('profile.isNull')->except(['create', 'store']);
        $this->middleware('profile.has')->only(['create']);
    }

    public function index()
    {
        $user = auth()->user();
        return view('profile.index', [
            'user' => $user
        ]);
    }

    public function create()
    {
        // Show create view
        return view('profile.create', ['countries' => $this->countries]);
    }

    public function show(User $user) {
        return view('profile.index', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        // Get request for showing the edit page 

        return view('profile.edit', ['countries' => $this->countries]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'country' => 'required',
            'description' => 'required',
            'languages' => 'required',
            'travel_list' => 'required',
        ]);

        auth()->user()->profile()->create($request->only([
            'title',
            'country',
            'description',
            'languages',
            'travel_list'
            ]));

        return redirect(route('profile.index'))->with('edit_success', 'You successfully created a profile!');
    }

    public function update(Request $request) 
    {
        // Put request for editing the user's profile data
        
        $user = auth()->user();

        $this->validate($request, [
            'username' => 'required|unique:users,username,'. $user->id, 
            'title' => 'required',
            'country' => 'required',
            'description' => 'required',
            'languages' => 'required',
            'travel_list' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:2048'
        ]);
        
        if ($request->hasFile('image')) {

            if ($user->profile->image && Storage::exists('public/' . $user->profile->image)) {
                // User already has an image and is uploading a new one.
                // Delete the current one they have from our disk storage
                Storage::delete('public/' . $user->profile->image);
            }

            $img = $request->file('image');

            $path = $img->store('profile', 'public');

            $imageArray = [
                'image' => $path
            ];
        }

        // Update username in user model
        $user->username = $request->username;
        $user->save();

        // Update attributes in the user's profile  model
        $user->profile->update(array_merge(
            $request->only([
            'title',
            'country',
            'description',
            'languages',
            'travel_list'
            ]),
            $imageArray ?? []
        ));

        return redirect(route('profile.index'))->with('edit_success', 'Profile updated!');
    }
}
