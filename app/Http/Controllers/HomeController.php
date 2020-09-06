<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

use App\Category;
use App\Note;
use App\Version;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('main', compact('categories'));
    }

    public function savenote(Request $request)
    {
        // print_r(json_encode($request->all()));
        // die;
        if(Auth::check()){
            $user_id = Auth::id();
            $request -> validate(['title' => 'required']);
            $note = new Note([
                'user_id' => $user_id,
                'title' => $request -> get('title'),
                'note' => $request -> get('editordata'),
                'category_id' => $request -> get('category')
            ]);

            $note -> save();
            $note_id = $note -> id;

            $version = new Version([
                'note_id' => $note_id,
                'title' => $request -> get('title'),
                'note' => $request -> get('editordata'),
                'category_id' => $request -> get('category'),
                'version' => 1
            ]);

            $version -> save();

            return redirect() -> back() -> with('message', 'Sačuvano!');
        }
    }

    public function update(Request $request)
    {
        // print_r(json_encode($request->all()));
        // die;
        if(Auth::check()){
            $user_id = Auth::id();
            $request -> validate(['title' => 'required']);
            $category_id = $request -> get('category');

            $note = Note::where('id', $request -> get('note_id'))->first();
            $note -> title = $request -> get('title');
            $note -> note = $request -> get('editordata');
            $note -> category_id = $category_id;

            $note -> save();

            $lastversion = Version::where('note_id', $request->get('note_id'))->latest()->first();

            // dump($lastversion->version);
            // die;

            if(!empty($lastversion)){
                $version_value = ++$lastversion -> version;
            } else {
                $version_value = 1;
            }

            $version = new Version([
                'note_id' => $request -> get('note_id'),
                'title' => $request -> get('title'),
                'note' => $request -> get('editordata'),
                'category_id' => $category_id,
                'version' => $version_value
            ]);

            $version -> save();
            return redirect() -> back() -> with('message', 'Sačuvano!');
        }
    }

    public function version($id){
        $note = Version::where('id', $id)->with('category')->first();
        $versions = Version::where('note_id', $note -> note_id)->get();
        return view('showversion', compact('note', 'versions'));
    }

    public function show($id){
        $note=Note::where('id', $id)->with('category')->first();
        $versions = Version::where('note_id', $id)->get();
        // print_r(json_encode($versions));
        // die;
        return view('show', compact('note', 'versions'));
    }

    public function edit($id){
        $categories = Category::all();
        $note=Note::where('id', $id)->first();
        return view('edit', compact('note', 'categories'));
    }
}
