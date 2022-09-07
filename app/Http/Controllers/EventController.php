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
        $books = Books::all();

        return view('welcome', ['books' => $books]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $books = new Books;

        $books->title = $request->title;

        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $requestFile = $request->file;
            $extension = $requestFile->extension();
            $fileName = md5($requestFile->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestFile->move(public_path('file/books'), $fileName);
            $books->file = $fileName;
        }

        $books->save();

        return redirect('/')->with('success', 'Livro enviado com succeso!');
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
