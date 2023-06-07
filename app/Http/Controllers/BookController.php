<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Character;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = [];
        if(session()->has('user')){
            $books = session()->get('user')->fresh()->books;
        }

        return view('books.index', compact('books'));
    }

    public function create(Request $request){

        $md5Name = md5_file($request->file('image')->getRealPath());
        $image_extension = $request->file('image')->guessExtension();
        $image_name = $md5Name . "." . $image_extension;
        $image_dir = '/imgs/books/covers/';

        $request->file('image')->move(public_path() . $image_dir, $image_name);
        $user = session()->get('user');

        $book = Book::query()->create([
            'title' => $request->input('title'),
            'image' => $image_dir . $image_name,
            'user_id' => $user->id,
        ]);

//        dd($request->all());

        return redirect('/book/' . $book->id);
    }

    public function info($id){
        $book = Book::query()
                        ->where('id', $id)
                        ->firstOrFail();

//        if($book->user != session()->get('user')){
//            return redirect('/');
//        }

        return view('books.info', compact('book'));
    }

    public function delete($id){
        $book = Book::query()
            ->where('id', $id)
            ->where('user_id', session()->get('user')->id)
            ->delete();

        return redirect('/books');
    }














    public function characters($book_id){
        $book = Book::query()
                        ->where('id', $book_id)
                        ->firstOrFail();

        return view('books.characters', compact('book'));
    }



}
