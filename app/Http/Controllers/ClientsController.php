<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    protected $users;
    protected $clients;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings
    ) {
        $this->users    = $users;
        $this->clients  = $clients;
        $this->settings = $settings;
        $this->middleware('client.create', ['only' => ['create']]);
        $this->middleware('client.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clients.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function me()
    {
        return view('clients.my');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('clients.create', [
            'users'      => $this->users->getAllUsersWithDepartments(),
            'industries' => $this->clients->listAllIndustries()
        ]);
    }

    /**
     * @param StoreClientRequest $request
     *
     * @return mixed
     */
    public function store(StoreClientRequest $request)
    {
        $this->clients->create($request->all());

        return redirect()->route('clients.index');
    }

    /**
     * @param Request $vatRequest
     *
     * @return mixed
     */
    public function cvrapiStart(Request $vatRequest)
    {
        return redirect()->back()
            ->with('data', $this->clients->vat($vatRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return view('clients.show', [
            'client'   => $this->clients->find($id),
            'invoices' => $this->clients->getInvoices($id),
            'users'    => $this->users->getAllUsersWithDepartments()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        return view('clients.edit', [
            'client'     => $this->clients->find($id),
            'users'      => $this->users->getAllUsersWithDepartments(),
            'industries' => $this->clients->listAllIndustries()
        ]);
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     *
     * @return mixed
     */
    public function update($id, UpdateClientRequest $request)
    {
        $this->clients->update($id, $request);
        session()->flash('flash_message', 'Client successfully updated');

        return redirect()->route('clients.index');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $this->clients->destroy($id);

        return redirect()->route('clients.index');
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $this->clients->updateAssign($id, $request);
        session()->flash('flash_message', 'New user is assigned');

        return redirect()->back();
    }
}
