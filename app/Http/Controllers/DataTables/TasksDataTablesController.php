<?php

namespace App\Http\Controllers\DataTables;

use App\Models\Task;
use Carbon;

class TasksDataTablesController extends DataTablesController
{
    public function allTasks()
    {
        $tasks = Task::with('client')->whereStatus(1);

        return $this->datatables->eloquent($tasks)
            ->addColumn('title_link', function ($tasks) {
                return '<a href="'.route('tasks.show', $tasks->id).'">'.$tasks->title.'</a>';
            })
            ->addColumn('client_name', function ($tasks) {
                return $tasks->client->name;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->deadline))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('user_assigned_id', function ($tasks) {
                return $tasks->user->name;
            })
            ->rawColumns(['title_link'])
            ->toJson();
    }

    public function myTasks()
    {
        $tasks = Task::with('client')->whereStatus(1)->my();

        return $this->datatables->eloquent($tasks)
            ->addColumn('title_link', function ($tasks) {
                return '<a href="'.route('tasks.show', $tasks->id).'">'.$tasks->title.'</a>';
            })
            ->addColumn('client_name', function ($tasks) {
                return $tasks->client->name;
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->deadline))
                    ->format('d/m/Y') : '';
            })
            ->rawColumns(['title_link'])
            ->toJson();
    }
}
