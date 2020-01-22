<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

abstract class DataTablesController extends Controller
{
    /**
     *
     * @var DataTables
     */
    protected $datatables;

    public function __construct(DataTables $datatables)
    {
        $this->datatables = $datatables;
    }
}
