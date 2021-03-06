<?php

namespace App\Http\Controllers\DataTables;

use App\Models\Lead;
use Carbon;

class LeadsDataTablesController extends DataTablesController
{
    /**
     * Data for Data tables.
     *
     * @return mixed
     */
    public function allLeads()
    {
        $leads = Lead::whereStatus(1);

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
        $leads = Lead::whereStatus(1)->my();

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
