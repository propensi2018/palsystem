<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Rating;
use App\Salesperson;
use App\ProductType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DateTime;


class RiwayatController extends Controller
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
    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show_call($id)
    {
        $call = DB::table('schedules')
            ->join('customers', 'schedules.id_customer', '=', 'customers.id')
            ->where('schedules.id', $id)
            ->select('schedules.created_at', 'schedules.notes', 'customers.name')
            ->first();

        return view('riwayat_call', ['call' => $call]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_appointment($id)
    {
        $appointment = DB::table('schedules')
            ->join('customers', 'schedules.id_customer', '=', 'customers.id')
            ->where('schedules.id', $id)
            ->select('schedules.created_at', 'schedules.notes', 'customers.name')
            ->first();

        return view('riwayat_appointment', ['appointment' => $appointment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_all(){
        $id =Auth::id();
        $salesperson_history = DB::table('schedules')
            ->join('schedule_types', 'schedules.schedule_type_id', '=', 'schedule_types.id')
            ->join('customers', 'schedules.id_customer', '=', 'customers.id')
            ->where('schedules.id_user_sp', $id)
            ->select('schedules.created_at','schedule_types.telp_flag','customers.name', 'schedules.id')
            ->get();

        $salesperson = DB::table('salespeople')
            ->join('users', 'salespeople.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->select('salespeople.id_sp', 'users.name')
            ->first();

        date_default_timezone_set("Asia/Bangkok");
        $date = date('d-m');
        $inputSls = '7'; //best performance Salesperson user id
        $inputProdAgr  = '1';//best performance ProductType id for Aggresif
        $inputProdMod  = '2';//best performance ProductType id  for Moderate
        $inputProdCons = '3';//best performance ProductType id for Conservative
        //add reward
        if($date == '13-05'){
            $currentYear = date("y");
            if(sizeof(Rating::All()) !== 0){
            $latestYear = substr((Rating::select('date')->orderBy('date','desc')->first()->date),2,2);
          }else{
            $latestYear = 0;
          }

          if($currentYear !== $latestYear ){

               //ADD SLS REWARD
               $newReward = new Rating;
               $newReward->sales_user_id = $inputSls;
               $newReward->date = new DateTime();
               $newReward->save();

               //ADD PROD REWARD
               $newReward = new Rating;
               $newReward->product_types_id = $inputProdAgr;
               $newReward->date = New DateTime();
               $newReward->save();

               $newReward = new Rating;
               $newReward->product_types_id = $inputProdMod;
               $newReward->date = New DateTime();
               $newReward->save();

               $newReward = new Rating;
               $newReward->product_types_id = $inputProdCons;
               $newReward->date = New DateTime();
               $newReward->save();
          }
        }
        //set reward to UI======================================================================================

        $user = User::find($id);
        $is_sp = User::select('is_sp')->where('id',$id)->get()->first()->is_sp;
        //for salesperson view
        if($is_sp == 1){
          if((Rating::where('sales_user_id',$id)->get()->first()) !== null ){
            $amountRating =  Rating::where('sales_user_id',$id)->count();
            return view('riwayat', ['salesperson_history' => $salesperson_history, 'salesperson' => $salesperson, 'amountRating'=> $amountRating]);
          }else{
            $amountRating = 0;
            return view('riwayat', ['salesperson_history' => $salesperson_history, 'salesperson' => $salesperson, 'amountRating'=> $amountRating]);
          }
        }
    }



}
