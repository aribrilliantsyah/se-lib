<?php

namespace App\Http\Controllers;

use App\Helpers\Dummy;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\BooksDataTable;
use DB;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BooksDataTable $dataTable)
    {
        //
       return $dataTable->render('pages.book.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $authors = Author::all();
        $categories = Category::all();
        return view('pages.book.create',compact('authors','categories'));
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
            'book' => 'required|max:255',
            'summary' => 'required|max:255',
            'stock' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'cover' => '',
        ]);
        
        $code = Book::generateCodeBook();
        $trx = Book::create([
            'code' => $code,
            'book' => $request->book,
            'summary' => $request->summary,
            'stock' => $request->stock,
            'author_id' => $request->author_id,
            'cover' => $request->cover,
        ]);
        $book_id = $trx->id;
        if(count($request->category_id) > 0){
            foreach ($request->category_id as $dt) {
                DB::table('book_category')->insert([
                    'book_id' => $book_id,
                    'category_id' => $dt,
                ]);
            }
        }
        if($trx){
            return redirect()->route('book.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('book.index')->with(['error' => 'Data Failed to Save!']);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
        $data = $book;
        $catAll = [];
        foreach($data->categories as $dt)
        {
            $catAll[] = $dt->id;
        } 
        $id = $data->id;
        $authors = Author::all();
        $categories = Category::all();
        return view('pages.book.edit', compact('data', 'id','authors','categories','catAll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
        $request->validate([
            'book' => 'required|max:255',
            'summary' => 'required|max:255',
            'stock' => 'required',
            'author_id' => 'required',
            'category_id' => 'required',
            'cover' => '',
        ]);
        $req = $request->except(['category_id']);
        $trx = $book->update($req);
        
        $book_id = $book->id;
        if(count($request->category_id) > 0){
            DB::table('book_category')->where('book_id', $book_id)->delete();

            foreach ($request->category_id as $dt) {
                DB::table('book_category')->insert([
                    'book_id' => $book_id,
                    'category_id' => $dt,
                ]);
            }
        }

        if($trx){
            return redirect()->route('book.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('book.index')->with(['error' => 'Data Failed to Save!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
        try {
            $delete = $book->delete();
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
