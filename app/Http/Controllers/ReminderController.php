<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Schedule;
use App\ScheduleType;
use App\Prospect;
use App\Address;
use App\Statistic;
use App\Appointment;
use App\Telephone;

use App\User;
use App\Rating;
use App\Branch;
use App\Salesperson;
use App\ProductType;
use App\ProductListAssoc;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DateTime;

class ReminderController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_all()
    {
        // $customers = Schedule::find($id)->Customer;
        $id = Auth::id();
        $role = Auth::user() -> role();
        $allSchedule = Schedule::where('id_user_sp', $id) -> get();

        $scheduleIsDone = array();
        $schedules = array();
        $customer = array();
        $sched_cal = array();

        $telephone = '';
        for ($i=0; $i < sizeof($allSchedule) ; $i++) {
            if ($allSchedule[$i] -> is_done == 0) {
                $getCustomer = Customer::where('id', $allSchedule[$i] -> id_customer) -> get();
                $getActivity = ScheduleType::where('id', $allSchedule[$i] -> schedule_type_id) -> get();
                $getTelephone = Telephone::find($allSchedule[$i] -> id_customer);

                $clock = explode(' ', $allSchedule[$i] ->time);
                $date = $clock[0];
                $hour = explode(':', $clock[1]);
                $minute = explode(':', $clock[1]);
                $times = $hour[0] . ':' . $minute[1];
                $now = date("Y-m-d");

                if ($getActivity[0] -> telp_flag == 0 && $date == $now) {
                    $schedules[] = array('id' => $allSchedule[$i] -> id, 'is_done' => $allSchedule[$i] -> is_done, 'time' => $times, 'notes' => $allSchedule[$i] -> notes, 'schedule_type_id' => $allSchedule[$i] -> schedule_type_id, 'telp_flag' => $getActivity[0] -> telp_flag, 'id_customer' => $allSchedule[$i] -> id_customer, 'name' => $getCustomer[0] -> name, 'telp_no' => $getTelephone -> telp_no, 'id_user_sp' => $allSchedule[$i] -> id_user_sp);
                } elseif ($getActivity[0] -> telp_flag == 1 && $date == $now) {
                    $getAddress = Address::where('prospect_customer_id', $allSchedule[$i] -> id_customer) -> get();
                    $schedules[] = array('id' => $allSchedule[$i] -> id, 'is_done' => $allSchedule[$i] -> is_done, 'time' => $times, 'notes' => $allSchedule[$i] -> notes, 'schedule_type_id' => $allSchedule[$i] -> schedule_type_id, 'telp_flag' => $getActivity[0] -> telp_flag, 'id_customer' => $allSchedule[$i] -> id_customer, 'name' => $getCustomer[0] -> name, 'telp_no' => $getTelephone -> telp_no, 'id_user_sp' => $allSchedule[$i] -> id_user_sp, 'street' => $getAddress[0] -> street, 'kelurahan' => $getAddress[0] -> kelurahan, 'district' => $getAddress[0] -> district);
                }

                //calendar
                if ($getActivity[0] -> telp_flag == 0) {
                    $sched_cal[] = array('act' => $date, 'id' => $allSchedule[$i] -> id, 'is_done' => $allSchedule[$i] -> is_done, 'time' => $times, 'notes' => $allSchedule[$i] -> notes, 'schedule_type_id' => $allSchedule[$i] -> schedule_type_id, 'telp_flag' => $getActivity[0] -> telp_flag, 'id_customer' => $allSchedule[$i] -> id_customer, 'name' => $getCustomer[0] -> name, 'telp_no' => $getTelephone -> telp_no, 'id_user_sp' => $allSchedule[$i] -> id_user_sp);
                } elseif ($getActivity[0] -> telp_flag == 1) {
                    $getAddress = Address::where('prospect_customer_id', $allSchedule[$i] -> id_customer) -> get();
                    $sched_cal[] = array('act' => $date, 'id' => $allSchedule[$i] -> id, 'is_done' => $allSchedule[$i] -> is_done, 'time' => $times, 'notes' => $allSchedule[$i] -> notes, 'schedule_type_id' => $allSchedule[$i] -> schedule_type_id, 'telp_flag' => $getActivity[0] -> telp_flag, 'id_customer' => $allSchedule[$i] -> id_customer, 'name' => $getCustomer[0] -> name, 'telp_no' => $getTelephone -> telp_no, 'id_user_sp' => $allSchedule[$i] -> id_user_sp, 'street' => $getAddress[0] -> street, 'kelurahan' => $getAddress[0] -> kelurahan, 'district' => $getAddress[0] -> district);
                }
            }
        }

        date_default_timezone_set("Asia/Bangkok");
        $today1 = date('Y-m-d');
        $today2 = date('H:i');
        $today = $today1.'T'.$today2;

        //HANDLING STATISTICS (author : Farhan Np)
        $statistics = new Statistic;
        $data = $statistics->product_data();
        $labels = $statistics->returnLabels();

        //handling statistik salesperson
        $dataSales = $statistics-> sales_data($id);
        //add reward








        date_default_timezone_set("Asia/Bangkok");
        $date = date('d-m');


          $currentYear = date("y");


          if(sizeof(Rating::All()) !== 0){
          $latestYear = substr((Rating::select('date')->orderBy('date','desc')->first()->date),2,2);
          }else{
            $latestYear = 0;
          }


                  $agresiveProduct = array();
                  $moderateProduct = array();
                  $conservativeProduct = array();
                  $salesPersonPerformance = array();
                  $candidate = new Statistic;


                  //calculate product agresive
                  $agr = ProductType::where('id_class', 1)->get();
                  foreach($agr as $productType){
                    array_push($agresiveProduct,$candidate -> calculateProductYear($currentYear-1, $productType->id));
                  }

                  //calculate product moderate
                  $mod = ProductType::where('id_class', 2)->get();
                  foreach($mod as $productType){
                    array_push($moderateProduct,$candidate -> calculateProductYear($currentYear-1, $productType->id));
                  }
                  //calculate product consecative
                  $con = ProductType::where('id_class', 3)->get();
                  foreach($con as $productType){
                    array_push($conservativeProduct,$candidate -> calculateProductYear($currentYear-1, $productType->id));
                  }

                  //calculate salesperson
                  $sls = User::where('is_sp',1)->get();
                  foreach($sls as $slss ){
                    array_push($salesPersonPerformance, $candidate -> calculateSalespersonYear($currentYear-1,$slss->id));
                  }

                

                  //REWARD LIST SLS & Produk



          if($currentYear != ($latestYear+1) ){

              if(max($agresiveProduct)[0] != 0 ){

                $inputProdAgr  = max($agresiveProduct)[1];//best performance ProductType id for Aggresif
                $newReward = new Rating;
                $newReward->product_types_id = $inputProdAgr;
                $newReward->date = '20'. $currentYear-1;
                $newReward->save();
              }
              if(max($moderateProduct)[0] != 0){
                $inputProdMod  = max($moderateProduct)[1];//best performance ProductType id  for Moderate
                $newReward = new Rating;
                $newReward->product_types_id = $inputProdMod;
                $newReward->date = '20'. $currentYear-1;
                $newReward->save();
              }
              if(max($conservativeProduct)[0] != 0){
                $inputProdCons =max($conservativeProduct)[1];//best performance ProductType id for Conservative
                $newReward = new Rating;
                $newReward->product_types_id = $inputProdCons;
                $newReward->date = '20'. $currentYear-1;
                $newReward->save();
              }
              if(max($salesPersonPerformance)[0] != 0){
                $inputSls = max($salesPersonPerformance)[1]; //input best salesperson performance
                $newReward = new Rating;
                $newReward->sales_user_id = $inputSls;
                $newReward->date = '20'. $currentYear-1;
                $newReward->save();
              }
          }



        //set reward to UI======================================================================================
        if($role == 'branch_manager'){
        $id = Auth::id();
        $user = User::find($id);
        $is_sp = User::select('is_sp')->where('id',$id)->get()->first()->is_sp;

        $idBranch = Branch::select('level_id')->where('mgr_user_id',$id)->get()->first()->level_id;
        $jml = sizeof(Rating::all());
        $listRatingSls = array();
        $listRatingProd = array();

        $rat1 = DB::table('salespeople')
        ->join('ratings', 'salespeople.user_id' , '=', 'ratings.sales_user_id')
        ->select('ratings.*')
        ->where('branch_level_id', $idBranch)
        ->get();

        $rat2 = DB::table('ratings')
        ->whereNotNull('product_types_id')
        ->get();

        $ratings = $rat1 -> merge($rat2);

        foreach($ratings as $rating) {
          if (isset($rating -> sales_user_id))
          {
          $nameSls = User::find($rating -> sales_user_id) -> name;

          $yearSls = substr($rating -> date, 0,4);
          $listRatingSls[] =  array('name' => $nameSls,'year'=> $yearSls );
          }
          else if (isset($rating -> product_types_id))
          {
          $nameProd = ProductType::find($rating-> product_types_id) -> desc;
          $yearProd = substr($rating -> date, 0,4);
          $listRatingProd[] =  array('name' => $nameProd,'year'=> $yearProd );
          }
        }

        return view('dashboard',compact('listRatingProd','listRatingSls','role', 'labels', 'data', 'today', 'sched_cal','dataSales'));
        }

        return view('dashboard', compact('role', 'labels', 'data', 'schedules', 'today', 'sched_cal','dataSales'));
    }








    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scheduleResponse(Request $request)
    {
        $id = Auth::id();

        if (request ('customer_type') == "Prospect") {

            // COMPLETED
            $strApp = new Appointment();
            $strApp ->is_a_deal = 0;
            $strApp ->id_act_type = 1;
            $strApp->save();

            $strScTp = new ScheduleType();
            $strScTp ->telp_flag = 1;
            $strScTp -> appointment() -> associate($strApp);
            $strScTp->save();

            $strSch = new Schedule;
            $strSch->is_done = 0;
            $strSch->cycle = 1;
            $strSch->time = request('time');
            $strSch->notes = request('notes');
            $strSch->response = request('customer_type');
            $strSch -> scheduleType() -> associate($strScTp);
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Schedule::where('id', request('id'))->update(['is_done' => true]);
            return view('form_prospect',compact('strSch'));
        }

        else if (request ('customer_type') == "Pending") {
            $strApp = new Appointment();
            $strApp ->is_a_deal = 0;
            $strApp ->id_act_type = 1;
            $strApp->save();

            $strScTp = new ScheduleType;
            $strScTp->telp_flag = 0;
            $strScTp->save();

            $strSch = new Schedule;
            $strSch->is_done = 0;
            $strSch->time = request('time');
            $strSch->notes = request('notes');
            $strSch->cycle = 1;
            $strSch->response = request('customer_type');
            $strSch -> scheduleType() -> associate($strScTp);
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Schedule::where('id', request('id'))->update(['is_done' => true]);
            return redirect()->route('main');
        }

        else {
            $strApp = new Appointment();
            $strApp ->is_a_deal = 0;
            $strApp ->id_act_type = 1;
            $strApp->save();

            $strScTp = new ScheduleType;
            $strScTp->telp_flag = 1;
            $strScTp->save();

            $strSch = new Schedule;
            $strSch->is_done = 1;
            $strSch->cycle = 1;
            $strSch->notes = request('notes');
            $strSch->response = request('customer_type');
            $strSch -> scheduleType() -> associate($strScTp);
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Schedule::where('id', request('id'))->update(['is_done' => true]);
            return redirect()->route('main');
        }
    }





}
