<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Integration;
use Illuminate\Http\Request;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Invoice\InvoiceRepositoryContract;

class TasksController extends Controller
{
    protected $request;
    protected $tasks;
    protected $clients;
    protected $settings;
    protected $users;
    protected $invoices;

    public function __construct(
        TaskRepositoryContract $tasks,
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        InvoiceRepositoryContract $invoices,
        SettingRepositoryContract $settings
    ) {
        $this->tasks    = $tasks;
        $this->users    = $users;
        $this->clients  = $clients;
        $this->invoices = $invoices;
        $this->settings = $settings;

        $this->middleware('task.create', ['only' => ['create']]);
        $this->middleware('task.update.status', ['only' => ['updateStatus']]);
        $this->middleware('task.assigned', ['only' => ['updateAssign', 'updateTime']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('tasks.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function me()
    {
        return view('tasks.my');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('tasks.create', [
            'users'   => $this->users->getAllUsersWithDepartments(),
            'clients' => $this->clients->listAllClients()
        ]);
    }

    /**
     * @param StoreTaskRequest $request
     *
     * @return mixed
     */
    public function store(StoreTaskRequest $request) // uses __construct request
    {
        $getInsertedId = $this->tasks->create($request);

        return redirect()->route('tasks.show', $getInsertedId);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function show(Request $request, $id)
    {
        return view('tasks.show', [
            'tasks'        => $this->tasks->find($id),
            'users'        => $this->users->getAllUsersWithDepartments(),
            'invoiceLines' => $this->tasks->getInvoiceLines($id),
            'companyname'  => $this->settings->getCompanyName()
        ]);
    }

    /**
     * Sees if the Settings from backend allows all to complete tasks
     * or only assigned user. if only assigned user:.
     *
     * @param $id
     * @param Request $request
     *
     * @return
     *
     * @internal param $ [Auth]  $id Checks Logged in users id
     * @internal param $ [Model] $task->user_assigned_id Checks the id of the user assigned to the task
     * If Auth and user_id allow complete else redirect back if all allowed execute
     * else stmt
     */
    public function updateStatus($id, Request $request)
    {
        $this->tasks->updateStatus($id, $request);
        session()->flash('flash_message', 'Task is completed');

        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $clientId = $this->tasks->getAssignedClient($id)->id;

        $this->tasks->updateAssign($id, $request);
        session()->flash('flash_message', 'New user is assigned');

        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return mixed
     */
    public function updateTime($id, Request $request)
    {
        $this->tasks->updateTime($id, $request);
        session()->flash('flash_message', 'Time has been updated');

        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return mixed
     */
    public function invoice($id, Request $request)
    {
        $task             = Task::findOrFail($id);
        $clientId         = $task->client()->first()->id;
        $timeTaskId       = $task->time()->get();
        $integrationCheck = Integration::first();

        if ($integrationCheck) {
            $this->tasks->invoice($id, $request);
        }
        $this->invoices->create($clientId, $timeTaskId, $request->all());
        session()->flash('flash_message', 'Invoice created');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return mixed
     *
     * @internal param int $id
     */
    public function marked()
    {
        Notifynder::readAll(\Auth::id());

        return redirect()->back();
    }
}
