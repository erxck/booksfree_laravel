<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Books;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');

        if($search) {
            $books = Books::where([
                ['title', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $books = Books::all();
        }


        return view('welcome', ['books' => $books, 'search' => $search]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'file' => 'required|mimes:pdf|max: 50000',
        ]);

        $books = new Books;

        $books->title = $request->title;

        try {
            if($request->hasFile('file') && $request->file('file')->isValid()) {
                $requestFile = $request->file;
                $extension = $requestFile->extension();
                $fileName = md5($requestFile->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestFile->move(public_path('file/books'), $fileName);
                $books->file = $fileName;
            }

            $books->save();

            return redirect('/')->with('success', 'Livro enviado com sucesso!');
        } catch (\Throwable $error) {
            return redirect('/')->with("error", "Ocorreu um erro inesperado: { $error }");
        }

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
