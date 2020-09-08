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
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $categories = Category::all();
        return view('main', compact('categories'));
    }

    public function savenote(Request $request){
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

            return redirect('home/show/'.$note_id.'/1')->with('message', 'Sačuvana nova stavka!');
        }
    }

    public function update(Request $request){
        if(Auth::check()){
            $user_id = Auth::id();
            $type = $request -> get('type');
            $request -> validate(['title' => 'required']);
            $category_id = $request -> get('category');

            if($type == 1){
                $note = Note::where('id', $request -> get('note_id'))->first();
                $lastversion = Version::where('note_id', $request->get('note_id'))->latest()->first();
            } else {
                $version_note = Version::where('id', $request -> get('note_id'))->first();
                $note = Note::where('id', $version_note -> note_id)->first();
                $lastversion = Version::where('note_id', $version_note -> note_id)->latest()->first();
            }

            $note -> title = $request -> get('title');
            $note -> note = $request -> get('editordata');
            $note -> category_id = $category_id;

            $note -> save();

            if(!empty($lastversion)){
                $version_value = ++$lastversion -> version;
            } else {
                $version_value = 1;
            }

            $version = new Version([
                'note_id' => $lastversion -> note_id,
                'title' => $request -> get('title'),
                'note' => $request -> get('editordata'),
                'category_id' => $category_id,
                'version' => $version_value
            ]);

            $version -> save();
            return redirect('home/show/'.$request->get('note_id').'/1')->with('message', 'Sačuvana izmjena!');
        }
    }

    public function show($id, $type){
        if($type == 1){
            $note=Note::where('id', $id)->with('category')->first();
            $versions = Version::where('note_id', $id)->get()->sortBy('version');

        } else {
            $note = Version::where('id', $id)->with('category')->first();
            $versions = Version::where('note_id', $note -> note_id)->get()->sortBy('version');
        }

        // print_r(json_encode($note));
        // die;

        return view('show', compact('note', 'versions', 'type'));
    }

    public function edit($id, $type){
        $categories = Category::all();

        if($type == 1){
            $note=Note::where('id', $id)->first();
        } else {
            $note=Version::where('id', $id)->first();
        }

        // print_r(json_encode($note));
        // die;

        return view('edit', compact('note', 'categories', 'type'));
    }
}
