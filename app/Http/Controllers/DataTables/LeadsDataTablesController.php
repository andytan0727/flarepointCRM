<?php

namespace App\Http\Controllers\DataTables;

use App\Models\Lead;
use Carbon;
use Yajra\DataTables\DataTables;

class LeadsDataTablesController extends DataTablesController
{
    public function __construct(DataTables $datatables)
    {
        parent::__construct($datatables);
    }

    /**
     * Data for Data tables.
     *
     * @return mixed
     */
    public function allLeads()
    {
        $leads = Lead::where('status', 1);

        return $this->datatables->eloquent($leads)
            ->addColumn('title_link', function ($leads) {
                return '<a href="'.route('leads.show', $leads->id).'">'.$leads->title.'</a>';
            })
            ->editColumn('user_created_id', function ($leads) {
                return $leads->creator->name;
            })
            ->editColumn('contact_date', function ($leads) {
                return $leads->contact_date ? with(new Carbon($leads->contact_date))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('user_assigned_id', function ($leads) {
                return $leads->user->name;
            })
            ->rawColumns(['title_link'])
            ->toJson();
    }

    /**
     * Data for Data tables.
     *
     * @return mixed
     */
    public function myLeads()
    {
        $leads = Lead::where('status', 1)->my();

        return $this->datatables->eloquent($leads)
            ->addColumn('title_link', function ($leads) {
                return '<a href="'.route('leads.show', $leads->id).'">'.$leads->title.'</a>';
            })
            ->editColumn('user_created_id', function ($leads) {
                return $leads->creator->name;
            })
            ->editColumn('contact_date', function ($leads) {
                return $leads->contact_date ? with(new Carbon($leads->contact_date))
                    ->format('d/m/Y') : '';
            })
            ->rawColumns(['title_link'])
            ->toJson();
    }
}
