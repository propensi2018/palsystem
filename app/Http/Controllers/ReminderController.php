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
        
        return view('dashboard', compact('labels', 'data', 'schedules', 'today', 'sched_cal','dataSales'));
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
