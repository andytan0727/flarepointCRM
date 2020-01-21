<?php

namespace App\Http\Controllers\DataTables;

use Yajra\DataTables\DataTables;
use App\Models\Contact;
use DB;

class ContactsDataTablesController extends DataTablesController
{
    public function __construct(DataTables $datatables)
    {
        parent::__construct($datatables);
    }

    /**
     * Get all contacts to make a data table
     *
     * @return mixed
     */
    public function allContacts()
    {
        $user     = auth()->user();
        $contacts = Contact::select(['contacts.*', DB::raw('clients.name AS client_name')])->join('clients', 'contacts.client_id', '=', 'clients.id');

        $dt = $this->datatables->eloquent($contacts)
            ->addColumn('name_link', function ($contacts) {
                return '<a href="'.route('contacts.show', $contacts->id).'">'.$contacts->name.'</a>';
            })
            ->addColumn('email_link', function ($contacts) {
                return '<a href="mailto:'.$contacts->email.'">'.$contacts->email.'</a>';
            });

        // this looks weird, but in order to keep the two buttons on the same line
        // you have to put them both within the form tags if the Delete button is
        // enabled
        $actions = '';
        if ($user->can('contact-delete')) {
            $actions .= '<form action="{{ route(\'contacts.destroy\', $id) }}" method="POST">
            ';
        }
        if ($user->can('contact-update')) {
            $actions .= '<a href="{{ route(\'contacts.edit\', $id) }}" class="btn btn-xs btn-success" >Edit</a>';
        }
        if ($user->can('contact-delete')) {
            $actions .= '
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" name="submit" value="Delete" class="btn btn-xs btn-danger" onClick="return confirm(\'Are you sure?\')"">
                {{csrf_field()}}
            </form>';
        }

        return $dt
                 ->addColumn('actions', $actions)
                 ->rawColumns(['name_link', 'email_link', 'actions'])
                 ->toJson();
    }

    /**
     * Get current auth user contacts
     *
     * @return mixed
     */
    public function myContacts()
    {
        $user     = auth()->user();
        $contacts = Contact::select(['contacts.*', DB::raw('clients.name AS client_name')])->join('clients', 'contacts.client_id', '=', 'clients.id')->my();

        $dt = $this->datatables->eloquent($contacts)
            ->addColumn('name_link', function ($contacts) {
                return '<a href="'.route('contacts.show', $contacts->id).'">'.$contacts->name.'</a>';
            })
            ->addColumn('email_link', function ($contacts) {
                return '<a href="mailto:'.$contacts->email.'">'.$contacts->email.'</a>';
            });

        // this looks weird, but in order to keep the two buttons on the same line
        // you have to put them both within the form tags if the Delete button is
        // enabled
        $actions = '';
        if ($user->can('contact-delete')) {
            $actions .= '<form action="{{ route(\'contacts.destroy\', $id) }}" method="POST">
            ';
        }
        if ($user->can('contact-update')) {
            $actions .= '<a href="{{ route(\'contacts.edit\', $id) }}" class="btn btn-xs btn-success" >Edit</a>';
        }
        if ($user->can('contact-delete')) {
            $actions .= '
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" name="submit" value="Delete" class="btn btn-xs btn-danger" onClick="return confirm(\'Are you sure?\')"">
                {{csrf_field()}}
            </form>';
        }

        return $dt
                 ->addColumn('actions', $actions)
                 ->rawColumns(['name_link', 'email_link', 'actions'])
                 ->toJson();
    }
}
