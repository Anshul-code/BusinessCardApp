<?php

namespace App\DataTables;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContactDataTable extends DataTable
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
            ->of($query)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '
                        <button class="btn btn-danger btn-sm put" id="'. $row->id .'" data-toggle="modal" data-target="#confirmModal"><span class="fas fa-trash-alt"></span></button>
                      ';
                return $btn;
            })
            ->editColumn('created_at', function($row){
                    return date('F j,Y (H:i)', strtotime($row->created_at));
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contact $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->applyScopes(Contact::where('user_id', Auth::user()->id)->where('is_deleted', 'false')->get());
      
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('data-table-messages')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('csv'),
                        Button::make('excel'),
                        Button::make('print'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            
            'No' => ['data'=>'DT_RowIndex','name'=> 'DT_RowIndex'],
            Column::make('name'),
            Column::make('email'),
            Column::make('subject'),
            Column::make('message'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Contact_Messages_' . date('YmdHis');
    }
}
