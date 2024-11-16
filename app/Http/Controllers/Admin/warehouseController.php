<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class warehouseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Warehouse Home Page Method
    public function index()
    {
        $warehouse=DB::table('warehouses')->get();
        return view('admin.category.warehouse.index', compact('warehouse'));
    }

}
