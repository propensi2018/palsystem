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

        for ($i=0; $i < sizeof($allSchedule) ; $i++) {
            if ($allSchedule[$i] -> is_done == 0) {
                $getCustomer = Customer::where('id', $allSchedule[$i] -> id_customer) -> get();
                $getActivity = ScheduleType::where('id', $allSchedule[$i] -> schedule_type_id) -> get();

                $clock = explode(' ', $allSchedule[$i] ->time);
                $date = $clock[0];
                $sched_cal[] = array('act' => $date);
                $hour = explode(':', $clock[1]);
                $minute = explode(':', $clock[1]);
                $times = $hour[0] . ':' . $minute[1];
                $now = date("Y-m-d");

                if ($getActivity[0] -> telp_flag == 0 && $date == $now) {
                    $schedules[] = array('id' => $allSchedule[$i] -> id, 'is_done' => $allSchedule[$i] -> is_done, 'time' => $times, 'notes' => $allSchedule[$i] -> notes, 'schedule_type_id' => $allSchedule[$i] -> schedule_type_id, 'telp_flag' => $getActivity[0] -> telp_flag, 'id_customer' => $allSchedule[$i] -> id_customer, 'name' => $getCustomer[0] -> name, 'telp_no' => $getCustomer[0] -> telp_no, 'id_user_sp' => $allSchedule[$i] -> id_user_sp);
                } elseif ($getActivity[0] -> telp_flag == 1 && $date == $now) {
                    $getProspect = Prospect::where('customer_id', $getCustomer[0]['id']) -> get();
                    $getAddress = Address::where('id', $getProspect[0]['address_id']) -> get();
                    $schedules[] = array('id' => $allSchedule[$i] -> id, 'is_done' => $allSchedule[$i] -> is_done, 'time' => $times, 'notes' => $allSchedule[$i] -> notes, 'schedule_type_id' => $allSchedule[$i] -> schedule_type_id, 'telp_flag' => $getActivity[0] -> telp_flag, 'id_customer' => $allSchedule[$i] -> id_customer, 'name' => $getCustomer[0] -> name, 'telp_no' => $getCustomer[0] -> telp_no, 'id_user_sp' => $allSchedule[$i] -> id_user_sp, 'street' => $getAddress[0] -> street, 'kelurahan' => $getAddress[0] -> kelurahan, 'district' => $getAddress[0] -> district);
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



        $agresiveProduct = array();
        $moderateProduct = array();
        $conservativeProduct = array();
        $salesPersonPerformance = array();
        $candidate = new Statistic;


        //calculate product agresive
        $agr = ProductType::where('id_class', 1)->get();
        foreach($agr as $productType){
          array_push($agresiveProduct,$candidate -> calculateProductYear(2018, $productType->id));
        }

        //calculate product moderate
        $mod = ProductType::where('id_class', 2)->get();
        foreach($mod as $productType){
          array_push($moderateProduct,$candidate -> calculateProductYear(2018, $productType->id));
        }

        //calculate product consecative
        $con = ProductType::where('id_class', 3)->get();
        foreach($con as $productType){
          array_push($conservativeProduct,$candidate -> calculateProductYear(2018, $productType->id));
        }
        //calculate salesperson
        $sls = User::where('is_sp',1)->get();
        foreach($sls as $slss ){
            $salesPersonPerformance[] = array(  $slss->id => $candidate -> calculateSalespersonYear(2018,$slss->id));
        }


        //REWARD LIST SLS & Produk
        date_default_timezone_set("Asia/Bangkok");
        $date = date('d-m');
        $inputSls = key(max($salesPersonPerformance)); //input best salesperson performance
        $inputProdAgr  = ProductListAssoc::select('id_ptype')->where('amount',max($agresiveProduct))->get()->first()->id_ptype;//best performance ProductType id for Aggresif
        $inputProdMod  = ProductListAssoc::select('id_ptype')->where('amount',max($moderateProduct))->get()->first()->id_ptype;//best performance ProductType id  for Moderate
        $inputProdCons = ProductListAssoc::select('id_ptype')->where('amount',max($conservativeProduct))->get()->first()->id_ptype;//best performance ProductType id for Conservative

        //add reward
        if($date == '16-05'){
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

               $newReward = new Rating;
               $newReward->product_types_id = $inputProdAgr;
               $newReward->date = New DateTime();
               $newReward->save();
               //ADD PROD REWARD
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
        $id = Auth::id();
        $user = User::find($id);
        $is_sp = User::select('is_sp')->where('id',$id)->get()->first()->is_sp;
        // return $role;
        //for salesperson view
        if($role == 'branch_manager'){

          $idBranch = Branch::select('level_id')->where('mgr_user_id',$id)->get()->first()->level_id;
          $jml = sizeof(Rating::all());
          $listRatingSls = array();
          $listRatingProd = array();

          $rat1 = DB::table('salespeople')
          ->join('ratings', 'salespeople.user_id' , '=', 'ratings.sales_user_id')
          ->select('ratings.*')
          ->where('branch_level_id', $idBranch)
          ->get();

          // return $rat1;
          // return $id_salespeople;

          $rat2 = DB::table('ratings')
          ->whereNotNull('product_types_id')
          ->get();

          // return $rat2;
          $ratings = $rat1 -> merge($rat2);
          // return $ratings;
          // return $id_sp;


          // return [$id_sp];
          // $ratings = Rating::find([1,2]);



          // $ratings = array_merge($rat1, $rat2);
          // ->whereNotNull('product_type_id');
          // return [$ratings[0] -> sales_user_id];
          ;
          // return [$ratings];
          foreach($ratings as $rating) {
            if (isset($rating -> sales_user_id))
            {
            $nameSls = User::find($rating -> sales_user_id) -> name;

            // return [$nameSls];

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

        // return $listRatingProd;


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
            // $strApp ->id = sizeof(Appointment::select('id')->get())+1;
            $strApp ->is_a_deal = 0;
            $strApp ->id_act_type = 1;
            $strApp->save();

            $strScTp = new ScheduleType();
            $strScTp ->telp_flag = 1;
            // $strScTp->id_appt = sizeof(Appointment::select('id')->get());
            $strScTp -> appointment() -> associate($strApp);
            $strScTp->save();

            $strSch = new Schedule;
            $strSch->is_done = 0;
            $strSch->time = request('time');
            $strSch->notes = request('notes');
            $strSch -> scheduleType() -> associate($strScTp);
            // $strSch->id_schedule_types = sizeof(ScheduleType::select('id')->get());
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            // $notes = Schedule::select('notes')->where('id', sizeof(Schedule::select('id')->get()));
            return view('form_prospect',compact('strSch'));
        }

        else if (request ('customer_type') == "Pending") {
            $strScTp = new ScheduleType;
            $strScTp->telp_flag = 0;
            $strScTp->save();

            $strSch = new Schedule;
            $strSch->is_done = 0;
            $strSch->time = request('time');
            $strSch->notes = request('notes');
            $strSch -> scheduleType() -> associate($strScTp);
            // $strSch->id_schedule_types = sizeof(ScheduleType::select('id')->get());
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Schedule::where('id', request('id'))->update(['is_done' => true]);
            return redirect()->route('main');
        }

        else {
            $strScTp = new ScheduleType;
            $strScTp->telp_flag = 1;
            $strScTp->save();

            $strSch = new Schedule;
            $strSch->is_done = 1;
            $strSch->notes = request('notes');
            $strSch -> scheduleType() -> associate($strScTp);
//            $strSch->id_schedule_types = sizeof(ScheduleType::select('id')->get());
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Schedule::where('id', request('id'))->update(['is_done' => true]);
            return redirect()->route('main');
        }
    }





}
