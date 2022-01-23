<?php

namespace App\DataTables;

use App\Models\Member;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MembersDataTable extends DataTable
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
            ->addColumn('image', function ($data) {
                $image = $data->photo == '' ? asset('assets/img/theme/team-3.jpg') : $data->photo;
                return '<img class="avatar rounded-circle" src="'.$image.'">';
            })
            ->addColumn('action', function ($data) {
                return '<a href="'.route('member.edit', $data->id).'" class="btn btn-sm btn-primary btn-fab btn-icon btn-round"><i class="fas fa-edit"></i></a>
                <button onclick="destroy(`'.route('member.destroy',$data->id).'`, `'.$data->id.'`)" class="btn btn-sm btn-danger btn-fab btn-icon btn-round"><i class="fas fa-trash"></i></button>
                <a href="'.route('member.show', $data->id).'" class="btn btn-sm btn-info btn-fab btn-icon btn-round"><i class="fas fa-eye"></i></a>';
            })
            ->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Member $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Member $model)
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
                    ->setTableId('members-table')
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
            Column::computed('image')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
                  ->title('photo'),
            Column::make('code'),
            Column::make('full_name'),
            Column::make('gender'),
            Column::make('address'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Members_' . date('YmdHis');
    }
}
