<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StockBalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
    }
   
   

    public function index()
    {
    
        if (request()->ajax()) 
        {

            $data = DB::table('sto_stock_balance')
            ->join('users','sto_stock_balance.user_id','users.id')
            ->join('sto_item','sto_stock_balance.item_id','sto_item.id')
            ->select('sto_stock_balance.*','users.username','sto_item.product_name','sto_item.barcode')
            ->where('sto_stock_balance.is_active',1)
            ->get();
            return datatables()->of($data)
                // ->addColumn('check', function($row){
                //     $input = "<input type='checkbox' id='ch{$row->id}' value='{$row->id}'>";
                //     return $input;
                // })
                // ->addColumn('photo', function($row){
                //     $url = asset($row->photo);
                //     $img = "<img src='{$url}' width='27'>";
                //     return $img;
                // })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'sto_item', 'sto_item');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('stock_balance.index');
    }
}
