<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
                $image = $data->avatar == '' ? asset('assets/img/theme/team-3.jpg') : $data->avatar;
                return '<img class="avatar rounded-circle" src="'.$image.'">';
            })
            ->addColumn('action', function ($data) {
                return '<a href="'.route('user.edit', $data->id).'" class="btn btn-sm btn-primary btn-fab btn-icon btn-round"><i class="fas fa-edit"></i></a>
                <button onclick="destroy(`'.route('user.destroy',$data->id).'`, `'.$data->id.'`)" class="btn btn-sm btn-danger btn-fab btn-icon btn-round"><i class="fas fa-trash"></i></button>
                <a href="'.route('user.show', $data->id).'" class="btn btn-sm btn-info btn-fab btn-icon btn-round"><i class="fas fa-eye"></i></a>';
            })
            ->addColumn('role', function ($data) {
                return '<span class="badge badge-primary">'.$data->role->role.'</span>';
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('Y-m-d H:i:s');
            })->rawColumns(['image', 'action', 'role']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->with('role')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(6);
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
            Column::make('image')
                  ->addClass('text-center'),
            Column::make('name'),
            Column::make('username'),
            Column::make('email'),
            Column::make('role'),
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
        return 'Users_' . date('YmdHis');
    }
}
