<?php

namespace App\DataTables;

use App\Models\Book;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BooksDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('cover', function ($data) {
                $cover = $data->cover == '' ? asset('assets/img/theme/team-3.jpg') : $data->cover;
                return '<img class="book-cover" src="'.$cover.'">';
            })
            ->addColumn('author', function ($data) {
                return $data->author->author;
            })
            ->addColumn('category', function($data) {
                $html = '';
                if(count($data->categories) > 0){
                    $html = '<span class="badge badge-info">'.$data->categories->implode('category', '</span> <span class="badge badge-info">').'</span>';
                }
                return $html;
            })
            ->addColumn('action', function ($data) {
                return '<a href="'.route('book.edit', $data->id).'" class="btn btn-sm btn-primary btn-fab btn-icon btn-round"><i class="fas fa-edit"></i></a>
                <button onclick="destroy(`'.route('book.destroy',$data->id).'`, `'.$data->id.'`)" class="btn btn-sm btn-danger btn-fab btn-icon btn-round"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['cover', 'author','category','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Book $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Book $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('books-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('cover')
                  ->addClass('text-center'),
            Column::computed('code')
                  ->title('Book Code'),
            Column::computed('book')
                 ->title('title'),
            Column::computed('author')
                 ->title('Author Name'),
            Column::computed('category')
                 ->title('Categories'),
            Column::make('summary'),
        ];
            
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Books_'.date('YmdHis');
    }
}
