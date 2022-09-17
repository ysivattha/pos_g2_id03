<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
    }
    // read

    public function index()
    {
        if (request()->ajax()) {
            $cus = DB::table('customer')
            ->join('users','customer.user_id','users.id')
            ->join('type_customer','customer.type_id','customer.id')
            ->select('customer.*','users.username','type_customer.type')
            ->get();
            return datatables()->of($cus)
            ->addIndexColumn()
            ->addColumn('action', function($cus) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $cus->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $cus->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        return view('customers.index');
    }
}