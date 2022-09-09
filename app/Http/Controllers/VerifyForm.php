<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyForm extends Controller
{
    private $name;
    private $file;

    public function __construct(request $request)
    {
        $this->title = $request->title;
        $this->file = $request->file;
    }

    public function sendFile($request, $books)
    {
        // $books = new Books;

        // $books->title = $request->title;

        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $requestFile = $request->file;
            $extension = $requestFile->extension();
            $fileName = md5($requestFile->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestFile->move(public_path('file/books'), $fileName);
            $books->file = $fileName;
        }

        $books->save();
    }
}
