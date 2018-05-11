<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\Prospect;
use App\Schedule;
use App\ScheduleType;
use App\ProspectWillingness;
use App\CustomerType;
use App\ActivityType;
use App\Appointment;
use App\Address;
use App\Telephone;
use Illuminate\Support\Facades\DB;

class DataTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id =Auth::id();

        $TransData=DB::table('transactions')
        ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
        ->join('product_list_assocs', 'product_list_assocs.product_list_id', '=', 'product_lists.id')
        ->join('schedules', 'product_lists.schedule_id', '=', 'schedules.id')
        ->join('customers', 'schedules.id_customer', '=', 'customers.id')
        // ->join('telephones', 'custome    rs.id', '=', 'telephones.customer_id') ditambahin
        ->where('transactions.is_valid', '=', '1')->get();

        $returner = array();
        $index = 0;
        $indexObject = "";
        foreach($transData as $singleData) {
          if ($singleData -> id == $index) {
            $indexObject -> id_ptype = $indexObject -> id_ptype . "," $singleData -> id_ptype;
          }
          array_push($returner, $singleData);
          $index = $singleData -> id;
          $indexObject = $singleData;

        }

        return $returner;

        return view('data_transaksi',compact('TransData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
