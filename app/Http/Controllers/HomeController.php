<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

use App\Category;
use App\Note;
use App\Favorite;
use App\Version;
use App\Tag;
use App\TagConnection;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('main');
    }

    public function savenote(Request $request){
        if(Auth::check()){
            $user_id = Auth::id();
            $request -> validate(['title' => 'required']);
            $note = new Note([
                'user_id' => $user_id,
                'title' => $request -> get('title'),
                'note' => $request -> get('editordata'),
                'language' => $request ->get('language'),
            ]);

            $note -> save();
            $note_id = $note -> id;

            //tags
            if(!empty($request -> get('tags'))){
                $tags = explode(' ', $request -> get('tags'));
                foreach($tags as $tag){
                    $tag_id = Tag::where('tag', $tag)->first();
                    if(!empty($tag_id -> id)){
                        $tag_connection = new TagConnection([
                            'tag_id' => $tag_id -> id,
                            'note_id' => $note_id,
                        ]);

                        $tag_connection -> save();

                    } else {
                        $tag_insert = new Tag([
                            'tag' => $tag
                        ]);
                        $tag_insert -> save();

                        $tag_connection = new TagConnection([
                            'tag_id' => $tag_insert -> id,
                            'note_id' => $note_id,
                        ]);

                        $tag_connection -> save();
                    };
                };
            } else {
                $tag_id = Tag::where('tag', '#not_tagged')->first();
                $tag_connection = new TagConnection([
                    'tag_id' => $tag_id -> id,
                    'note_id' => $note_id,
                ]);

                $tag_connection -> save();
            }


            // version
            $version = new Version([
                'note_id' => $note_id,
                'title' => $request -> get('title'),
                'note' => $request -> get('editordata'),
                'language' => $request -> get('language'),
                'version' => 1
            ]);

            $version -> save();

            return redirect('home/show/'.$note_id.'/1')->with('message', 'Sačuvana nova stavka!');
        }
    }

    public function update(Request $request){
        if(Auth::check()){
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
            $note -> language = $request -> get('language');

            $note -> save();
            $note_id = $note -> id;

            if(!empty($lastversion)){
                $version_value = ++$lastversion -> version;
            } else {
                $version_value = 1;
            }

            $version = new Version([
                'note_id' => $lastversion -> note_id,
                'title' => $request -> get('title'),
                'note' => $request -> get('editordata'),
                'language' => $request -> get('language'),
                'version' => $version_value
            ]);

            $version -> save();

            //tags
            $old_tags = TagConnection::where('note_id', $note_id)->get();
            foreach($old_tags as $tag){
                $tag -> delete();
            }

            if(!empty($request -> get('tags'))){
                $tags = explode(' ', $request -> get('tags'));
                foreach($tags as $tag){
                    $tag_id = Tag::where('tag', $tag)->first();
                    if(!empty($tag_id -> id)){
                        $tag_connection = new TagConnection([
                            'tag_id' => $tag_id -> id,
                            'note_id' => $note_id,
                        ]);

                        $tag_connection -> save();

                    } else {
                        $tag_insert = new Tag([
                            'tag' => $tag
                        ]);
                        $tag_insert -> save();

                        $tag_connection = new TagConnection([
                            'tag_id' => $tag_insert -> id,
                            'note_id' => $note_id,
                        ]);

                        $tag_connection -> save();
                    };
                };
            } else {
                $tag_id = Tag::where('tag', '#not_tagged')->first();
                $tag_connection = new TagConnection([
                    'tag_id' => $tag_id -> id,
                    'note_id' => $note_id,
                ]);

                $tag_connection -> save();
            }

            return redirect('home/show/'.$request->get('note_id').'/1')->with('message', 'Sačuvana izmjena!');
        }
    }

    public function show($id, $type){
        if($type == 1){
            $note=Note::where('id', $id)->with('tags')->first();
            $versions = Version::where('note_id', $id)->get()->sortBy('version');
            $note_tags = TagConnection::where('note_id', $note -> id)
                ->leftJoin('tags','tags.id', '=', 'tag_connections.tag_id')
                ->get(['tag']);
        } else {
            $note = Version::where('id', $id)->with('tags')->first();
            $versions = Version::where('note_id', $note -> note_id)->get()->sortBy('version');
            $note_tags = TagConnection::where('note_id', $note -> note_id)
            ->leftJoin('tags','tags.id', '=', 'tag_connections.tag_id')
            ->get(['tag']);
        }

        return view('show', compact('note', 'versions', 'type', 'note_tags'));
    }

    public function edit($id, $type){
        if($type == 1){
            $note=Note::where('id', $id)->with('tags')->first();
            $note_tags = TagConnection::where('note_id', $note -> id)
            ->leftJoin('tags','tags.id', '=', 'tag_connections.tag_id')
            ->get(['tag']);

        } else {
            $note=Version::where('id', $id)->with('tags')->first();
            $note_tags = TagConnection::where('note_id', $note -> note_id)
            ->leftJoin('tags','tags.id', '=', 'tag_connections.tag_id')
            ->get(['tag']);
        }

        $tags_string = $note_tags -> implode('tag', ' ');

        return view('edit', compact('note', 'type', 'tags_string'));
    }
}
