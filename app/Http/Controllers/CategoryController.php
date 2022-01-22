<?php

namespace App\Http\Controllers;

use App\Helpers\Dummy;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('pages.category.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.category.create');
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
            'category' => 'required|max:255',
        ]);

        $trx = Category::create([
            'category' => $request->category
        ]);

        if($trx){
            return redirect()->route('category.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('category.index')->with(['error' => 'Data Failed to Save!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        $data = $category;
        $id = $data->id;
        return view('pages.category.edit', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $rules = [
            'category' => 'required|max:255',
        ];
        $request->validate($rules);
        $request = $request->all();

        $trx = $category->update($request);
        if($trx){
            return redirect()->route('category.index')->with(['success' => 'Data Saved Successfully!']);
        }else{
            return redirect()->route('category.index')->with(['error' => 'Data Failed to Save!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        try {
            $delete = $category->delete();
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
