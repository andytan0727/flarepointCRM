<?php

namespace App\Http\Controllers\DataTables;

use App\Models\Client;
use App\Models\User;
use App\Models\Lead;
use App\Models\Task;
use Carbon;
use Yajra\DataTables\DataTables;

class UsersDataTablesController extends DataTablesController
{
    public function __construct(DataTables $datatables)
    {
        parent::__construct($datatables);
    }

    public function allUsers()
    {
        $canUpdateUser = auth()->user()->can('update-user');
        $users         = User::select(['id', 'name', 'email', 'work_number']);

        return $this->datatables->eloquent($users)
            ->addColumn('name_link', function ($users) {
                return '<a href="users/'.$users->id.'">'.$users->name.'</a>';
            })
            ->addColumn('edit', function ($user) {
                return '<a href="'.route('users.edit', $user->id).'" class="btn btn-success"> Edit</a>';
            })
            ->addColumn('delete', function ($user) {
                return '<button type="button" class="btn btn-danger delete_client" data-client_id="'.$user->id.'" data-toggle="modal" data-target="#myModal">Delete</button>';
            })
            ->rawColumns(['name_link', 'edit', 'delete'])
            ->toJson();
    }

    public function tasks(User $user)
    {
        $tasks = Task::select(
            ['id', 'title', 'created_at', 'deadline', 'user_assigned_id', 'client_id', 'status']
        )
            ->where('user_assigned_id', $user->id);

        return $this->datatables->eloquent($tasks)
            ->addColumn('title_link', function ($tasks) {
                return '<a href="'.route('tasks.show', $tasks->id).'">'.$tasks->title.'</a>';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($tasks) {
                return $tasks->deadline ? with(new Carbon($tasks->deadline))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('status', function ($tasks) {
                return 1 == $tasks->status ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            })
            ->editColumn('client_id', function ($tasks) {
                return $tasks->client->name;
            })
            ->rawColumns(['title_link', 'status'])
            ->toJson();
    }

    public function leads(User $user)
    {
        $leads = Lead::select(
            ['id', 'title', 'created_at', 'contact_date', 'user_assigned_id', 'client_id', 'status']
        )
            ->where('user_assigned_id', $user->id);

        return $this->datatables->eloquent($leads)
            ->addColumn('title_link', function ($leads) {
                return '<a href="'.route('leads.show', $leads->id).'">'.$leads->title.'</a>';
            })
            ->editColumn('created_at', function ($leads) {
                return $leads->created_at ? with(new Carbon($leads->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('contact_date', function ($leads) {
                return $leads->contact_date ? with(new Carbon($leads->contact_date))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('status', function ($leads) {
                return 1 == $leads->status ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            })
            ->editColumn('client_id', function ($tasks) {
                return $tasks->client->name;
            })
            ->rawColumns(['title_link', 'status'])
            ->toJson();
    }

    /**
     * Json for Data tables.
     *
     * @param $id
     *
     * @return mixed
     */
    public function clients(User $user)
    {
        $client = Client::select(['id', 'name', 'primary_number', 'primary_email'])->where('user_id', $user->id);

        return $this->datatables->eloquent($client)
            ->addColumn('client_link', function ($client) {
                return '<a href="'.route('clients.show', $client->id).'">'.$client->name.'</a>';
            })
            ->addColumn('email_link', function ($client) {
                return '<a href="mailto:'.$client->primary_email.'">'.$client->primary_email.'</a>';
            })
            ->editColumn('created_at', function ($client) {
                return $client->created_at ? with(new Carbon($client->created_at))
                    ->format('d/m/Y') : '';
            })
            ->rawColumns(['client_link', 'email_link'])
            ->toJson();
    }
}
