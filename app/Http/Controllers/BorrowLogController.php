<?php

namespace App\Http\Controllers;

use App\DataTables\BorrowBooksDataTable;
use App\Helpers\Dummy;
use App\Models\Book;
use App\Models\BorrowLog;
use App\Models\Member;
use Illuminate\Http\Request;

class BorrowLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $member_id = $request->member_id;
        return view('pages.borrow_log.list', compact('member_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BorrowLog  $borrowLog
     * @return \Illuminate\Http\Response
     */
    public function show(BorrowLog $borrowLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BorrowLog  $borrowLog
     * @return \Illuminate\Http\Response
     */
    public function edit(BorrowLog $borrowLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BorrowLog  $borrowLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BorrowLog $borrowLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BorrowLog  $borrowLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(BorrowLog $borrowLog)
    {
        //
    }

    /**
     * Display a reporting of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        //
        $data = [
            'collection' => Dummy::borrow_logs()
        ];
        return view('pages.borrow_log.report', $data);
    }

    /**
     * Return a response json of list members.
     *
     * @return \Illuminate\Http\Response
     */
    public function member_list(Request $request){
        $searchTerm = $request->searchTerm;
        if(!$searchTerm){ 
            $json = [];
        }else{
            $search = $searchTerm;
            $result = Member::where('full_name', 'like', '%'.$search.'%')->get();
            $json = [];

            foreach($result as $item){
                $default = asset('/assets/img/theme/team-3.jpg');
                // dd($default);
                $photo = isset($item['photo']) ? $item['photo'] : $default;
                $json[] = [
                    'id' => $item->id, 
                    'text'=> $item->code.' - '.strtoupper($item->full_name),
                    'html' => '<div class="d-flex flex-row">
                        <div class="p-2 align-self-center">
                            <img onerror="this.src=\''.$default.'\'" src="'.$photo.'" class="avatar rounded-circle" >
                        </div>
                        <div class="p-2 d-flex flex-column align-content-center justify-content-center">
                            <h4>'.strtoupper($item->full_name).'</h4>
                            <h6 class="text-muted">'.$item->code.'</h6>
                        </div>
                    </div>'
                ];
            }
        }
    
        return response()->json($json);
    }

    /**
     * Return a response json of detail member.
     *
     * @return \Illuminate\Http\Response
     */
    public function member_detail($member_id){
        $qRes = Member::find($member_id);
        
        return response()->json([
            'status' => true,
            'data' => $qRes
        ]);
    }

    /**
     * Return a response json of borrowed books.
     *
     * @return \Illuminate\Http\Response
     */
    public function borrowed_books($member_id){
        $qRes = BorrowLog::with('book')->where('member_id', '=', $member_id)->get();

        return response()->json([
            'status' => true,
            'data' => $qRes
        ]);
    }

    /**
     * Display a borrow page.
     *
     * @return \Illuminate\Http\Response
     */
    public function borrow($member_id)
    {
        //
        $dataTable = new BorrowBooksDataTable();
        return $dataTable->with('member_id', $member_id)->render('pages.borrow_log.borrow', [
            'member_id' => $member_id 
        ]);
    }

    /**
     * Process a borrow transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function on_borrow($member_id, $book_id){
        $stock = Book::stock($book_id);
        if($stock > 0){
            $created = BorrowLog::create([
                'book_id' => $book_id,
                'member_id' => $member_id,
                'is_returned' => 0,
                'return_estimate' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 7 days')).' 17:00:00',
            ]);

            if($created){
                Book::decrease($book_id);
            }
            return redirect('admin/borrow_log/borrow/'.$member_id)->with(['success' => 'Successfully added to borrow list!']); 
        }else{
            return redirect('admin/borrow_log/borrow/'.$member_id)->with(['error' => 'Stock of book is 0!']);
        }
    }

    
    /**
     * Process a return transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function on_return($member_id, $book_id, $borrow_id){
        $updated = BorrowLog::find($borrow_id)->update([
            'is_returned' => 1
        ]);

        if($updated){
            Book::increase($book_id);
        }
        return redirect('admin/borrow_log?member_id='.$member_id)->with(['success' => 'Successfully returned the book!']); 
    }
}
