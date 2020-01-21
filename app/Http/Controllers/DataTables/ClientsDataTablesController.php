<?php

namespace App\Http\Controllers\DataTables;

use App\Models\Client;
use DB;
use Yajra\DataTables\DataTables;

class ClientsDataTablesController extends DataTablesController
{
    public function __construct(DataTables $datatables)
    {
        parent::__construct($datatables);
    }

    public function allClients()
    {
        $user    = auth()->user();
        $clients = Client::select(['clients.*', DB::raw('users.name AS salesperson')])->join('users', 'clients.user_id', '=', 'users.id');

        $dt = $this->datatables->eloquent($clients)
            ->addColumn('name_link', function ($clients) {
                return '<a href="'.route('clients.show', $clients->id).'">'.$clients->name.'</a>';
            })
            ->addColumn('email_link', function ($clients) {
                return '<a href="mailto:'.$clients->primary_email.'">'.$clients->primary_email.'</a>';
            });

        // this looks weird, but in order to keep the two buttons on the same line
        // you have to put them both within the form tags if the Delete button is
        // enabled
        $actions = '';
        if ($user->can('client-delete')) {
            $actions .= '<form action="{{ route(\'clients.destroy\', $id) }}" method="POST">
            ';
        }
        if ($user->can('client-update')) {
            $actions .= '<a href="{{ route(\'clients.edit\', $id) }}" class="btn btn-xs btn-success" >Edit</a>';
        }
        if ($user->can('client-delete')) {
            $actions .= '
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" name="submit" value="Delete" class="btn btn-danger btn-xs" onClick="return confirm(\'Are you sure?\')"">
                {{csrf_field()}}
            </form>';
        }

        return $dt
                 ->addColumn('actions', $actions)
                 ->rawColumns(['name_link', 'email_link', 'actions'])
                 ->toJson();
    }

    /**
     * Get current user's clients
     *
     * @return mixed
     */
    public function myClients()
    {
        $user    = auth()->user();
        $clients = Client::with('user')->select('clients.*')->my();

        $dt = $this->datatables->eloquent($clients)
            ->addColumn('name_link', function ($clients) {
                return '<a href="'.route('clients.show', $clients->id).'">'.$clients->name.'</a>';
            })
            ->addColumn('email_link', function ($clients) {
                return '<a href="mailto:'.$clients->primary_email.'">'.$clients->primary_email.'</a>';
            });

        // this looks weird, but in order to keep the two buttons on the same line
        // you have to put them both within the form tags if the Delete button is
        // enabled
        $actions = '';
        if ($user->can('client-delete')) {
            $actions .= '<form action="{{ route(\'clients.destroy\', $id) }}" method="POST">
            ';
        }
        if ($user->can('client-update')) {
            $actions .= '<a href="{{ route(\'clients.edit\', $id) }}" class="btn btn-xs btn-success" >Edit</a>';
        }
        if ($user->can('client-delete')) {
            $actions .= '
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" name="submit" value="Delete" class="btn btn-danger btn-xs" onClick="return confirm(\'Are you sure?\')"">
                {{csrf_field()}}
            </form>';
        }

        return $dt
                 ->addColumn('actions', $actions)
                 ->rawColumns(['name_link', 'email_link', 'actions'])
                 ->toJson();
    }
}
