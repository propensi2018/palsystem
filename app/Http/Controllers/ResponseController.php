<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
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
        return view('list_customers');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        if (request ('customer_type') == "Prospect") {

        $strApp = new Appointment;
        $strApp ->is_a_deal = 0;
        $strApp ->id_act_type = 1;

        $strScTp = new Schedule_type;
        $strScTp ->telp_flag = 1;
        $strScTp->id_appt = sizeof(Appointment::select('id')->get());

        $strSch = new Schedule;
        $strSch->is_done = 0;
        $strSch->time = request('time');
        $strSch->notes = request('notes');
        $strSch->customer_type_id = sizeof(Schedule_type::select('id')->get());;
        $strSch->id_customer = request('{{$customerz->id}}');
        $strSch->id_user_sp = $id;
        $strSch->save();

        }
        else if (request ('customer_type') == "Pending") {
        $strScTp = new Schedule_type;
        $strScTp ->telp_flag = 0;

        $strSch = new Schedule;
        $strSch->is_done = 0;
        $strSch->time = request('time');
        $strSch->notes = request('notes');
        $strSch->customer_type_id = sizeof(Schedule_type::select('id')->get());;
        $strSch->id_customer = request('{{$customerz->id}}');
        $strSch->id_user_sp = $id;
        $strSch->save();
        }
        else {

        }




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
}
