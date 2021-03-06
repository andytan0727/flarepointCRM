<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Lead\StoreLeadRequest;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Http\Requests\Lead\UpdateLeadFollowUpRequest;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class LeadsController extends Controller
{
    protected $leads;
    protected $clients;
    protected $settings;
    protected $users;

    public function __construct(
        LeadRepositoryContract $leads,
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings
    ) {
        $this->users    = $users;
        $this->settings = $settings;
        $this->clients  = $clients;
        $this->leads    = $leads;
        $this->middleware('lead.create', ['only' => ['create']]);
        $this->middleware('lead.assigned', ['only' => ['updateAssign']]);
        $this->middleware('lead.update.status', ['only' => ['updateStatus']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leads.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        return view('leads.my');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leads.create', [
            'users'   => $this->users->getAllUsersWithDepartments(),
            'clients' => $this->clients->listAllClients()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeadRequest|Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeadRequest $request)
    {
        $getInsertedId = $this->leads->create($request);
        session()->flash('flash_message', 'Lead is created');

        return redirect()->route('leads.show', $getInsertedId);
    }

    public function updateAssign($id, Request $request)
    {
        $this->leads->updateAssign($id, $request);
        session()->flash('flash_message', 'New user is assigned');

        return redirect()->back();
    }

    /**
     * Update the follow up date (Deadline).
     *
     * @param UpdateLeadFollowUpRequest $request
     * @param $id
     *
     * @return mixed
     */
    public function updateFollowup(UpdateLeadFollowUpRequest $request, $id)
    {
        $this->leads->updateFollowup($id, $request);
        session()->flash('flash_message', 'New follow up date is set');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('leads.show', [
            'lead'  => $this->leads->find($id),
            'users' => $this->users->getAllUsersWithDepartments(),
            'companyname' => $this->settings->getCompanyName()
        ]);
    }

    /**
     * Complete lead.
     *
     * @param $id
     * @param Request $request
     *
     * @return mixed
     */
    public function updateStatus($id, Request $request)
    {
        $this->leads->updateStatus($id, $request);
        session()->flash('flash_message', 'Lead is completed');

        return redirect()->back();
    }
}
