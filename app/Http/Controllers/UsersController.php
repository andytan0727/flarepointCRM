<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
use App\Repositories\Department\DepartmentRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\Lead\LeadRepositoryContract;

class UsersController extends Controller
{
    protected $users;
    protected $roles;
    protected $departments;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles,
        DepartmentRepositoryContract $departments,
        SettingRepositoryContract $settings,
        TaskRepositoryContract $tasks,
        LeadRepositoryContract $leads
    ) {
        $this->users       = $users;
        $this->roles       = $roles;
        $this->departments = $departments;
        $this->settings    = $settings;
        $this->tasks       = $tasks;
        $this->leads       = $leads;
        $this->middleware('user.create', ['only' => ['create']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::orderBy('name')->get()->pluck('name', 'id')
        ]);
    }

    public function users()
    {
        return User::all();
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('users.create', [
            'roles'       => $this->roles->listAllRoles(),
            'departments' => $this->departments->listAllDepartments()
        ]);
    }

    /**
     * @param StoreUserRequest $userRequest
     *
     * @return mixed
     */
    public function store(StoreUserRequest $userRequest)
    {
        $getInsertedId = $this->users->create($userRequest);

        return redirect()->route('users.index');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return view('users.show')->with([
            'user'           => $this->users->find($id),
            'companyname'    => $this->settings->getCompanyName(),
            'taskStatistics' => $this->tasks->totalOpenAndClosedTasks($id),
            'leadStatistics' => $this->leads->totalOpenAndClosedLeads($id)
        ]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        return view('users.edit', [
            'user'        => $this->users->find($id),
            'roles'       => $this->roles->listAllRoles(),
            'departments' => $this->departments->listAllDepartments()
        ]);
    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     *
     * @return mixed
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->users->update($id, $request);
        session()->flash('flash_message', 'User successfully updated');

        return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy(Request $request)
    {
        // load the user so we can get relational data
        $id   = $request->id;
        $user = User::with('clients', 'tasks', 'leads')->findOrFail($id);

        if ($request->user_clients == $id ||
            $request->user_tasks == $id ||
            $request->user_leads == $id) {
            session()->flash('flash_message_warning', 'You may not reassign clients, leads or tasks to the user you are deleting.');
        } else {
            // are we keeping her tasks?
            if ($user->tasks()->count() > 0) {
                if ('' == $request->user_tasks) {
                    // just delete all the tasks related to this user
                    $user->tasks()->delete();
                } else {
                    // move all clients to new user
                    foreach ($user->tasks as $task) {
                        $task->user_assigned_id = $request->user_tasks;
                        $task->save();
                    }
                }
            }

            // clean up tasks created but not assigned to the user
            $tasks = Task::where('user_created_id', $id)->get();
            if ('' == $request->user_tasks) {
                foreach ($tasks as $task) {
                    $task->user_created_id = $task->user_assigned_id;
                    $task->save();
                }
            } else {
                foreach ($tasks as $task) {
                    $task->user_created_id = $request->user_tasks;
                    $task->save();
                }
            }

            // refresh the user
            $user->refresh();

            // are we keeping her leads?
            if ($user->leads()->count() > 0) {
                if ('' == $request->user_leads) {
                    // just delete all the leads related to this user
                    $user->leads()->delete();
                } else {
                    // move all clients to new user
                    foreach ($user->leads as $lead) {
                        $lead->user_assigned_id = $request->user_leads;
                        $lead->save();
                    }
                }
            }

            // clean up leads created but not assigned to the user
            $leads = Lead::where('user_created_id', $id)->get();
            if ('' == $request->user_leads) {
                foreach ($leads as $lead) {
                    $lead->user_created_id = $lead->user_assigned_id;
                    $lead->save();
                }
            } else {
                foreach ($leads as $lead) {
                    $lead->user_created_id = $request->user_leads;
                    $lead->save();
                }
            }

            // refresh the user
            $user->refresh();

            // are we keeping her clients?
            if ($user->clients()->count() > 0) {
                if ('' == $request->user_clients) {
                    // just delete all the clients related to this user
                    foreach ($user->clients as $client) {
                        // clean out all remaining client tasks and leads
                        $client->tasks()->delete();
                        $client->leads()->delete();
                        $client->delete();
                    }
                } else {
                    // move all clients to new user
                    foreach ($user->clients as $client) {
                        $client->user_id = $request->user_clients;
                        $client->save();
                    }
                }
            }

            // refresh the user one more time
            $user->refresh();

            $user->delete();
            session()->flash('flash_message', 'User successfully deleted');
        }

        return redirect()->route('users.index');
    }
}
