<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all links from user
        $links = Link::where('user_id', auth()->user()->id)->get();
        return view('home')->with('links', $links);
    }

    public function editprofile()
    {
        return view('editprofile');
    }

    public function updateprofile(Request $request)
    {
        // Check if URL is valid
        if(
            strtolower($request->url) == "home" ||
            strtolower($request->url) == "addlink" ||
            strtolower($request->url) == "editprofile" ||
            strtolower($request->url) == "updateprofile" ||
            strtolower($request->url) == "deletelink" ||
            strtolower($request->url) == "updatelink"
        ){
            return redirect()->back()->with('error', 'URL is not valid.');
        }

        // Check if user URL exists
        $user = User::where('url', $request->url)->first();
        if ($user) {
            return redirect()->back()->with('error', 'This social link has already been taken.');
        }else{
            // Set user custom URL
            $user = User::find(auth()->user()->id);
            $user->url = $request->url;
            $user->save();
            return redirect()->route('home')->with('success', "Social link updated.");
        }
    }

    public function addlink()
    {
        return view('addlink');
    }

    public function updatelink(Request $request)
    {
        // Create a new link
        $url = $request->url;
        $scheme = parse_url($url, PHP_URL_SCHEME);
        if (empty($scheme)) {
            $url = 'http://' . ltrim($url, '/');
        }
        $link = new Link;
        $link->label = $request->label;
        $link->url = $url;
        $link->user_id = auth()->user()->id;
        $link->save();
        return redirect()->route('home')->with('success', "Link added.");
    }   

    public function deletelink(Request $request)
    {
        // Delete link
        $link = Link::find($request->id);
        $link->delete();
        return redirect()->route('home')->with('success', "Link deleted.");
    }
}
