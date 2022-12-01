<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Post;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Helpers\ApiFormatter;

class KonfirmasiController extends Controller
{

    public function index()
    {
        if (auth()->user()->role == 'Mahasiswa') {

            return view('konfirmasi.index', [
                'title' => 'Halaman Konfirmasi',
                'active' => 'konfirmasi',

                'forms' => Form::where('user_id', auth()->user()->id)->get()

            ]);
        } else if (auth()->user()->role == 'Organisasi') {

            $posts_id = Post::where('user_id', auth()->user()->id)->pluck('id');
            $forms_id = Form::whereIn('post_id', $posts_id)->where('status', 0)->pluck('id');
            $answers = Answer::whereIn('form_id', $forms_id)->get();

            return view('konfirmasi.index', [
                'title' => 'Halaman Konfirmasi',
                'active' => 'konfirmasi',
                'forms' => Form::whereIn('post_id', $posts_id)->where('status', 0)->latest()->get()
            ]);
        } else {
            return view('konfirmasi.index', [
                'title' => 'Halaman Konfirmasi',
                'active' => 'konfirmasi',
                'organizations' => User::where('active', false)->get()

            ]);
        }
    }

    public function show(Form $form)
    {

        $post_id = $form->post->id;
        $answers = Answer::where('form_id', $form->id)->get();
        $jawaban = [];

        foreach ($answers as $answer) {
            $jawaban[$answer->nomor] = $answer->jawaban;
        }

        return view('konfirmasi.show', [
            'title' => 'Halaman Konfirmasi',
            'active' => 'konfirmasi',
            'questions' => Question::where('post_id', $post_id)->get(),
            'answers' => $jawaban,
            'nomor' => 1,
            'form' => $form,

        ]);
    }

    public function accept(Form $form)
    {
        Form::where('id', $form->id)->update(['status' => 1]);
        return redirect('/konfirmasi');
    }

    public function reject(Form $form)
    {
        Form::where('id', $form->id)->update(['status' => 2]);
        return redirect('/konfirmasi');
    }
    public function acceptOrganization(User $user)
    {
        User::where('id', $user->id)->update(['active' => 1]);
        return redirect('/konfirmasi');
    }

    public function rejectOrganization(User $user)
    {
        User::destroy($user->id);
        return redirect('/konfirmasi');
    }
}
