<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Form;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\Question;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'question.*' => 'required',
            'title' => 'required|max:50',
            'slug' => 'required|unique:posts',
            'image' => 'image|file|max:5000',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/dashboard/posts/create')
                ->withErrors($validator)
                ->withInput();
        }
        $validatedData = $validator->validated();


        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        $validatedData['user_id'] = auth()->user()->id;

        Post::create($validatedData);
        $last = Post::latest()->first();

        $nomor = 1;
        foreach ($request->question as $q) {

            Question::create([
                'post_id' => $last->id,
                'pertanyaan' => $q,
                'nomor' => $nomor

            ]);
            $nomor++;
        }



        return redirect('/dashboard/posts')->with('success', 'Post Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->author->id === auth()->user()->id) {
            return view('dashboard.posts.show', [
                'post' => $post
            ]);
        } else {
            abort('403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->author->id === auth()->user()->id) {
            return view('dashboard.posts.edit', [
                'post' => $post
            ]);
        } else {
            abort('403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:50',
            'body' => 'required',
            'image' => 'image|file|max:5000'
        ];
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
        if ($request->file('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        $validatedData['user_id'] = auth()->user()->id;

        Post::where('id', $post->id)->update($validatedData);
        return redirect('/dashboard/posts')->with('success', 'Post Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Form::where('post_id', $post->id)->delete();
        if ($post->image) {
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post Berhasil Dihapus');
    }
    public function checkSlug(Request $request)
    {
        $slug =  SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
