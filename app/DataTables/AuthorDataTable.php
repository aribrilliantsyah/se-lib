<?php

namespace App\DataTables;

use App\Models\Author;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AuthorDataTable extends DataTable
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
             ->addColumn('action', function ($data) {
                return '<a href="'.route('author.edit', $data->id).'" class="btn btn-sm btn-primary btn-fab btn-icon btn-round"><i class="fas fa-edit"></i></a>
                <button onclick="destroy(`'.route('author.destroy',$data->id).'`, `'.$data->id.'`)" class="btn btn-sm btn-danger btn-fab btn-icon btn-round"><i class="fas fa-trash"></i></button>';
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns([ 'action','created_at', 'updated_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Author $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Author $model)
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
                    ->setTableId('author-table')
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
            Column::make('author'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Author_' . date('YmdHis');
    }
}
