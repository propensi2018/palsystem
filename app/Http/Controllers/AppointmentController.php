<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Customer;
use App\Prospect;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\ProspectWillingness;
use App\Schedule;
use App\ScheduleType;
use App\ProductType;
use App\ProductList;
use App\ProductListAssoc;
use App\ActivityType;

class AppointmentController extends Controller
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
    public function create($customer_id)
    {

      if (Auth::user() -> is_sp == 0) {
        abort(403, 'Unauthorized action.');
      }

      $customer = Customer::find($customer_id);
      $planned_date = $customer -> retrieve_last_schedule(Auth::id()) -> time;

      //RETRIEVING TODAY'S DATE
      date_default_timezone_set("Asia/Bangkok");
      $today1 = date('Y-m-d');
      $today2 = date('H:i');
      $today = $today1.'T'.$today2;

      // $planned_date = '2017-07-01';
      $planned_date = date('F d, Y H:i', strtotime($planned_date));

      $block = [
        'planned_date' => $planned_date,
        'customer_id' => $customer_id,
        'customer' => Customer::findOrFail($customer_id),
        'willingnesses' => ProspectWillingness::all(),
        'activity_types' => ActivityType::all(),
        'product_types' => ProductType::all(),
        'today' => $today,
      ];
      #return $block;
      return view('form_appointment2', $block);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return 'dubas';
        // GETTING FORM VALUES
        date_default_timezone_set("Asia/Bangkok");
        //getting current date and time
        $today1 = date('Y-m-d');
        $today2 = date('H:i');
        $today = $today1.'T'.$today2;

        //getting salesperson id
        $id_user_sp = Auth::id(); // TODO change this once authenticated

        //getting activity type id
        $id_activity_type = request('appointment_type');

        //getting notes
        $notes = request('notes');

        //getting customer id
        $id_customer = (int)request('customer_id');

        //getting next schedule date
        $next_schedule_date = request('next_app');

        // getting product amount
        $amount = request('amount0');
        // $amount = (int) str_replace(',','',$amount);
        // return  $amount;
        // return [$amount * 1000];
        //GETTING PREVIOUS ENTRIES
        $customer = Customer::find($id_customer);
        $all_entry = $customer -> retrieve_last_schedule($id_user_sp);
        // $all_entry = DB::table('schedules')
        //     ->join('schedule_types', 'schedule_types.id', '=', 'schedules.schedule_type_id')
        //     ->where('id_user_sp', $id_user_sp)
        //     ->where('id_customer', $id_customer)
        //     ->where('is_done',0)
        //     ->where('telp_flag',1)
        //     ->select('schedules.id as schedule_id','id_customer')
        //     ->get()->first();


        // return [$all_entry];
        //
        // return ::find($id_customer) -> customer_type_id;


        //CREATING NEXT APPOINTMENT
        // $next_appointment = new Appointment();
        $is_a_deal = 0;
        // $next_schedule = "";
        if ($id_activity_type == 4) {
          $is_a_deal = 1;
        }
        $next_schedule = "";
        if ($next_schedule_date != null) { //HANDLING WHETHER A SCHEDULE HAS NEXT APPOINTMENT
          // $next_appointment -> is_a_deal = $is_a_deal;
          // $next_appointment -> id_act_type = 1;

          $next_schedule_type = new ScheduleType();
          $next_schedule_type -> telp_flag = 1;

          $next_schedule_type -> save();
          // $next_schedule_type -> appointment() -> associate($next_appointment);


          $next_schedule = new Schedule;
          $next_schedule -> is_done = 0;
          $next_schedule -> time = $next_schedule_date;
          $next_schedule -> scheduleType() -> associate($next_schedule_type);
          $next_schedule -> id_customer = $id_customer;
          $next_schedule -> id_user_sp = $id_user_sp;
          $next_schedule -> notes = $notes;

          // return [$next_schedule];

          $next_schedule -> save();

        }
        // return [$next_schedule, $all_entry];

        //UPDATING CURRENT APPOINTMENT
        $schedule = "";
        if($all_entry == null) {
          return 'err';
          $appointment = new Appointment;
          $appointment -> id_act_type = $id_activity_type;
          $appointment -> is_a_deal = $is_a_deal;

          $appointment->save();

          $schedule_type = new ScheduleType();
          $schedule_type -> telp_flag = 1;
          $schedule_type -> appointment() -> associate($appointment);

          $schedule_type -> save();

          $schedule = new Schedule;
          $schedule -> is_done = 1;
          $schedule -> time = $today;
          $schedule -> scheduleType() -> associate($next_schedule_type);
          $schedule -> id_customer = $id_customer;
          $schedule -> id_user_sp = $id_user_sp;
          if($next_schedule_date != null)
            $schedule -> nextSchedule() -> associate($next_schedule);

          $schedule -> save();

        } else {

          $schedule = Schedule::findOrFail($all_entry -> schedule_id);
          $schedule -> is_done = 1;
          if($next_schedule_date != null)
            $schedule -> nextSchedule() -> associate($next_schedule);

          $appointment = new Appointment;
          $appointment -> id_act_type = $id_activity_type;
          $appointment -> is_a_deal = $is_a_deal;
          // $schedule -> scheduleType -> appointment() -> associate($appointment);
          $appointment -> id_act_type = $id_activity_type;
          $appointment -> save();

          $schedule_type = $schedule -> scheduleType;
          $schedule_type -> appointment() -> associate($appointment);
          $schedule_type -> save();

            $schedule->save();
        }

        //HANDLING THE PRODUCT SIDE
        $product_list = new ProductList;
        $product_list -> schedule() -> associate($schedule);
        $product_list -> save();
        $id = $product_list -> id;
        $i = 0;

        $flag = true;
        while($flag){
          if (request('product_type' .$i) == null) {
            break;
          }
          $product_type = request('product_type' . $i);
          $amount = request('amount' . $i);
          $amount = (int) str_replace(',','',$amount);

          $product_list_assoc = new ProductListAssoc;
          $product_list_assoc -> id_ptype = $product_type;
          $product_list_assoc -> amount = $amount;
          $product_list_assoc -> productList() -> associate($product_list);
          $product_list_assoc -> save();
          $i++;
        }


        //HANDLING CUSTOMER TYPING
        $customer = Prospect::where('customer_id', $id_customer)->get()->first();
        if($id_activity_type >= 3) {
          $customer -> customer_type_id = 2;
          $customer -> save();
        } else {
          $customer -> customer_type_id = 1;
          $customer -> save();
        }

        // return 'there';

        //ROUTING TO UNIQUE CODE
        if ($is_a_deal == 1){
          return redirect()->route('unique_code', ['id_pl' => $id, 'id_customer' => $id_customer]);
        }
        return redirect()->route('profile-prospect', ['id' => $id_customer]);

        //kalo ada amount = 0, gausah bikin product list
        //cari schedule dengan tanggal dan customer id_sp yang sama
        //cari schedule yang dikasih flag
        //bikin appointment, schedule_type
        //bikin product_list_assoc
        //bikin product_list, product_type
        // transaction kalo deal
        // fiuh
        /*
        id	4
is_done	0
time	"2018-04-10 19:24:35"
response	null
notes	null
id_schedule_types	4
id_customer	1
id_user_sp	4
id_sched_next	null
        */
        // $schedule = Schedule::where('id_user_sp',id_user_sp)
        //                     ->where('id_customer', $customer_id)
        //                     ->where('is_done',0)
        //                     ->where()
        //                     ->get()->first();
        // $schedule -> notes = request('notes');


        // $schedule = Schedule::findOrFail($entry -> i);
        // $schedule -> $notes = request('notes');
        // $schedule -> $notes = request('notes');

        // $appointment = Appointment::where('id_schedule',1)->get();
        // $schedule_type = $appointment -> ScheduleType;
        // return [$appointment, $schedule_type];


    }

    /**
     * Display the specifiedesource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return [request('haha')];
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
