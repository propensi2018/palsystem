<?php

namespace App\Http\Controllers;
use App\Schedule;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use App\Statistic;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{

    public function test(){
         $id = Auth::id();
         $user  = User::find($id);
        date_default_timezone_set("Asia/Bangkok");
        $m = date('m');
          $y = date('y');
       $statistic = new Statistic;
        $bubu = $statistic -> statisticSalesperson($m,$y,$id);
        
      return [$bubu];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return '/dashboard';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->username = $request->name . "yey";
        $user->password = $request->name . "123";

        $user -> save();

        return 'successful';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        #return User::findOrFail($id);
        return view('welcome', ['user' => User::findOrFail($id)]);
    }


   public function show_all()
    {
        #return User::findOrFail($id);
        return view ('users', ['users' => User::all()]);
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
