<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Models\Contact;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\User\UserRepositoryContract;

class ContactsController extends Controller
{
    protected $users;
    protected $contacts;
    protected $clients;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        ContactRepositoryContract $contacts,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings
    ) {
        $this->users    = $users;
        $this->contacts = $contacts;
        $this->clients  = $clients;
        $this->settings = $settings;
        $this->middleware('contact.create', ['only' => ['create']]);
        $this->middleware('contact.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contacts.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function me()
    {
        return view('contacts.my');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('contacts.create', [
            'clients' => $this->clients->listAllClients()
        ]);
    }

    /**
     * @param StoreContactRequest $request
     *
     * @return mixed
     */
    public function store(StoreContactRequest $request)
    {
        $this->contacts->create($request->all());

        return redirect()->route('contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', [
            'contact' => $contact,
            'users'   => $this->users->getAllUsersWithDepartments(),
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
        return view('contacts.edit', [
            'contact' => $this->contacts->find($id),
            'clients' => $this->clients->listAllClients()
        ]);
    }

    /**
     * @param $id
     * @param UpdateContactRequest $request
     *
     * @return mixed
     */
    public function update($id, UpdateContactRequest $request)
    {
        $this->contacts->update($id, $request);
        session()->flash('flash_message', 'Contact successfully updated');

        return redirect()->route('contacts.show', ['id' => $id]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $this->contacts->destroy($id);

        return redirect()->route('contacts.index');
    }
}
