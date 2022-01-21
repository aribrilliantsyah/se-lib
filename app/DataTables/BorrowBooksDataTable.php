<?php

namespace App\DataTables;

use App\Models\Book;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BorrowBooksDataTable extends DataTable
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
            ->addColumn('action', function($data) {
                $html = '<a href="'.url('admin/borrow_log/on_borrow/'.$this->member_id.'/'.$data->id).'" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Borrow</a>';
                return $html;
            })
            ->addColumn('image', function($data) {
                $default = asset('/assets/img/theme/team-3.jpg');
                $cover = isset($data->cover) ? $data->cover : $default;
                $html = '<img onerror="this.src=`'.$default.'`" src="'.$cover.'" class="book-cover">';
                return $html;
            })
            ->addColumn('category', function($data) {
                $html = '';
                if(count($data->categories) > 0){
                    $html = '<span class="badge badge-info">'.$data->categories->implode('category', '</span> <span class="badge badge-info">').'</span>';
                }
                return $html;
            })->addColumn('sum', function($data) {
                return strlen($data->summary) > 100 ? substr($data->summary, 0, 100).'...' : $data->summary;
            })->rawColumns(['image', 'action', 'sum', 'category']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Book $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Book $model)
    {
        return $model->with(['categories', 'author'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('borrowbooks-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
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
            Column::computed('image')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('book'),
            Column::make('author.author'),
            Column::make('stock'),
            Column::computed('category')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->title('Categories'),
            Column::computed('sum')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->title('Summary'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BorrowBooks_' . date('YmdHis');
    }
}
