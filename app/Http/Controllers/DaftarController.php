<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Post;
use App\models\Form;
use App\Models\Question;

class DaftarController extends Controller
{
    public function index(Post $post)
    {
        return view('daftar.index', [
            'active' => 'home',
            'title' => 'Form Pendaftaran',
            'questions' => Question::where('post_id', $post->id)->get(),
            'post' => $post
        ]);
    }
    public function store(Request $request, Post $post)
    {
        Form::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'status' => 0,

        ]);

        $form = Form::latest()->first();
        $nomor = 1;
        foreach ($request->jawaban as $j) {

            Answer::create([
                'user_id' => auth()->user()->id,
                'post_id' => $post->id,
                'jawaban' => $j,
                'nomor' => $nomor,
                'form_id' => $form->id
            ]);
            $nomor++;
        }
        return redirect('/konfirmasi')->with('success', 'Formulir pendaftaran telah terkirim');
    }
}
