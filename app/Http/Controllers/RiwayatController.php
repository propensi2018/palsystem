<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->select('schedules.created_at', 'schedules.notes', 'customers.name', 'schedules.response')
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
            ->join('schedule_types', 'schedules.schedule_type_id', '=', 'schedule_types.id')
            ->join('appointments', 'schedule_types.appointment_id', '=', 'appointments.id')
            ->join('activity_types', 'appointments.id_act_type', '=', 'activity_types.id')
            ->where('schedules.id', $id)
            ->select('schedules.created_at', 'schedules.notes', 'customers.name as customer_name', 'activity_types.name as activity_name')
            ->first();

        $products = DB::table('product_lists')
            ->join('product_list_assocs', 'product_lists.id', '=', 'product_list_assocs.product_list_id')
            ->join('product_types', 'product_list_assocs.id_ptype', '=', 'product_types.id')
            ->where('product_lists.schedule_id', $id)
            ->select('product_types.desc', 'product_list_assocs.amount')
            ->get();

        return view('riwayat_appointment', ['appointment' => $appointment, 'products' => $products]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_all() 
    {
        $id =Auth::id();
        $salesperson_history = DB::table('schedules')
            ->join('schedule_types', 'schedules.schedule_type_id', '=', 'schedule_types.id')
            ->join('customers', 'schedules.id_customer', '=', 'customers.id')
            ->where('schedules.id_user_sp', $id)
            ->select('schedules.created_at','schedule_types.telp_flag','customers.name', 'schedules.id', 'schedules.response')
            ->get();

        $salesperson = DB::table('salespeople')
            ->join('users', 'salespeople.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->select('salespeople.id_sp', 'users.name')
            ->first();

        return view('riwayat', ['salesperson_history' => $salesperson_history, 'salesperson' => $salesperson]);
    }
}
