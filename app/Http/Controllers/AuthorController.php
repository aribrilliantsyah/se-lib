<?php

namespace App\Http\Controllers;

use App\Helpers\Dummy;
use App\Models\Author;
use Illuminate\Http\Request;
use App\DataTables\AuthorDataTable;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthorDataTable $dataTable)
    {
        //
        return $dataTable->render('pages.author.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'author' => 'required|max:255',
        ]);

        $trx = Author::create([
            'author' => $request->author
        ]);

        if($trx){
            return redirect()->route('author.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('author.index')->with(['error' => 'Data Failed to Save!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
        $data = $author;
        $id = $data->id;
        return view('pages.author.edit', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
        $rules = [
            'author' => 'required|max:255',
        ];
        $request->validate($rules);
        $request = $request->all();

        $trx = $author->update($request);
        if($trx){
            return redirect()->route('author.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('author.index')->with(['error' => 'Data Failed to Save!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
        try {
            $delete = $author->delete();
            if($delete){
                return response()->json([
                    'message' => 'Data Deleted Successfully!'
                ]);
            }
            return response()->json([
                'message' => 'Data Failed Successfully!'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Data Failed, this data is still used in other modules !'
            ]);
        }
    }
}
