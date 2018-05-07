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

class AktivitasPanggilanController extends Controller
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
        if (Auth::user() -> is_sp == 0) {
            abort(403, 'Unauthorized action.');
        }

        return view('list_customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        return view('form_prospect');

    }
    public function showProspect()
    {
        //

    }

     public function show_all()
    {
        $id =Auth::id();

        $customery=Customer::where([['is_act', false], ['pic_sp_id', $id]])->get();

        $exCust=DB::table('prospects')->join('customers', 'prospects.customer_id', '=', 'customers.id')->where([['pic_sp_id', $id],['cycle', '>=', '1']])->get();

        foreach($customery as $individuals) { 
            $individuals -> telephones = array();
            $individuals -> telephones = Telephone::select('telp_no')->where('customer_id', $individuals->id)->get();
        }

        $joinProspect = DB::table('prospects')
        ->join('schedules','id_customer','=','customer_id')
        ->where('id_user_sp' , $id)
       ->orderBy('schedules.updated_at','desc')->get();


        $joinProspectId = DB::table('prospects')->select('customer_id')->leftJoin('schedules','id_customer','=','customer_id')->where([['id_user_sp' , $id],['is_done',0]])->groupBy('customer_id')->get();

        $joinProspectCustomer = DB::table('prospects')
            ->select('customer_id','appointments.id_act_type','activity_types.name','prospects.notes')
            ->join('schedules','id_customer','=','customer_id')
            ->join('schedule_types' , 'schedule_types.id','=','schedules.schedule_type_id')
             ->join('appointments','appointments.id','=','schedule_types.appointment_id')
            ->join('activity_types' , 'appointments.id_act_type','=','activity_types.id')
            ->where([
                ['id_user_sp' , $id],
                ['is_done',0]
            ])
           ->orderBy('time','ascending')->get();
        $allSchedule = Schedule::where('id_user_sp', $id)->get();
        $allNotes = Schedule::where('id_user_sp', $id)->get();
        date_default_timezone_set("Asia/Bangkok");

        $today1 = date('Y-m-d');
        $today2 = date('H:i');
        $today = $today1.'T'.$today2;

        $jumlah = sizeof($joinProspectId);
        $tempSchedule = array();
        $allScheduleCustomer = array();
        $allScheduleLoop = array();
        $temp= array();
        $allCustomer = array();
        $allProspect = array();
        $allNotes = array();
        $allAppointment = array();
        $allActivityType = array();
        $allCustomerType = array();
        $allCustomerWillingness = array();
        $allProspectNotes = array();
        $allAppointmentTes = array();
        $allProspectData = array();


            for($i=0;$i<$jumlah;$i++)
            {
                array_push($allProspect , $joinProspectId[$i]);

                array_push($allProspectNotes , Schedule::where([['id_customer' , $allProspect[$i] ->customer_id],['is_done',1]])->orderBy('created_at','desc')->get()->first());
                array_push($allProspectData ,Prospect::where('customer_id' , $allProspectNotes[$i]['id_customer'])->get()->first());

                array_push($allCustomer , Customer::where('id' , $allProspect[$i]->customer_id)->get());

                array_push($allScheduleCustomer , ScheduleType::where('id' , $allProspectNotes[$i]['schedule_type_id'])->get()->first());

             // array_push($allAppointment , Appointment::where('id' , $allScheduleCustomer[$i]->appointment_id)->get()->first());
              array_push($allAppointment , Appointment::where('id' , $allScheduleCustomer[$i]['appointment_id'])->get()->first());


                if($allAppointment[$i]!=null){
                     array_push($allCustomerType , CustomerType::where('id' , $allProspectData[$i]['customer_type_id'])->get());
                array_push($allCustomerWillingness ,ProspectWillingness::where('id',$allProspectData[$i]['prospect_willingness_id']) ->get());
                    //array_push($allActivityType , $joinProspectCustomer[$i]);
                    array_push($allActivityType , ActivityType::where('id',$allAppointment[$i]->id_act_type)->get());
                }
                else{
                    array_push($allCustomerWillingness ,0);
                    //array_push($allActivityType , $joinProspectCustomer[$i]);
                    array_push($allCustomerType , 0);
//                   array_push($allActivityType,ActivityType::where('id' , 1)->get());
                   array_push($allActivityType,ActivityType::where('id' , 1)->get());
                }
           $temp[] = array('dataProspect' => $allProspect[$i],

                            'dataProspectNotes' => $allProspectNotes[$i],
                            'dataCustomer' => $allCustomer[$i],
                            'dataProspectLengkap' =>$allProspectData[$i],
                            'dataScheduleTypeBaru' => $allScheduleCustomer[$i],
                            'dataAppointment' => $allAppointment[$i],
                            'dataActivityType' => $allActivityType[$i],
                           'dataTipeCustomer' => $allCustomerType[$i],
                            'dataTipeWillingness' => $allCustomerWillingness[$i]);


            }

//
return view('list_customers',compact('customery','temp','today','joinProspectCustomer','allActivityType', 'exCust'));
//         return compact('temp');

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
        Prospect::where('customer_id', $id)->delete();
    }

    public function store(Request $request)
    {
        // abort(403, 'test');

        // $validator = Validator::make($request->all(), [
        //     'telp_no_0' => 'required|unique:telephones,telp_no']);

        // if ($validator->fails()) {
        //     return redirect('list_customers')->withErrors($validator)->withInput();
        // }

        // $validatedData = $request->validate(['telp_no_0' => 'required|unique:telephones,telp_no']);
        $j = 0;
        $validator = array();
        $flag1 = true;
        while($flag1) {
            if (request('telp_no_'. $j)==null)
                break;
            $validator += ['telp_no_' . $j => 'required|unique:telephones,telp_no'];
            $j++;
        }

        $validate = $request -> validate($validator);

        $newCust = new Customer;
        $newCust->pic_sp_id = Auth::user()->id;
        $newCust->is_act = 0;
        $newCust->name = request('name');
        $newCust->save();
        $i = 0;

        $flag = true;
        while($flag) {
            if ($a = (request('telp_no_'. $i)==null))
                break;
            $newCust->telp_no = request('telp_no_'. $i);
            $telp = new Telephone;
            $telp -> telp_no = request('telp_no_'. $i);
            $telp -> customer() -> associate($newCust);
            $telp->save();
            $i++;

        }
        return redirect()->route('list_customers');
    }

    public function storeResponse(Request $request)
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

            // $strScTp ->telp_flag = 1;
            // $strScTp->appointment_id = sizeof(ScheduleType::select('id')->get());
            // //$strScTp -> appointment() -> associate($strApp);

            $strScTp ->telp_flag = 1;
            // $strScTp->id_appt = sizeof(Appointment::select('id')->get());
            $strScTp -> appointment() -> associate($strApp);

            $strScTp->save();

            $strSch = new Schedule;
            $strSch->is_done = 0;
            $strSch->time = request('time');
            $strSch->notes = request('notes');
            $strSch -> scheduleType() -> associate($strScTp);
            //$strSch->schedule_type_id = sizeof(ScheduleType::select('id')->get());
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            // $notes = Schedule::select('notes')->where('id', sizeof(Schedule::select('id')->get()));

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
            $strSch -> scheduleType() -> associate($strScTp);
            // $strSch->id_schedule_types = sizeof(ScheduleType::select('id')->get());
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Customer::where('id', request('id_customer')) ->update(['is_act'=>true]);
            return redirect()->route('list_customers');
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
            $strSch->notes = request('notes');
            $strSch -> scheduleType() -> associate($strScTp);
//            $strSch->id_schedule_types = sizeof(ScheduleType::select('id')->get());
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Customer::where('id', request('id_customer')) ->update(['is_act'=>true]);
            return redirect()->route('list_customers');
        }
    }

    public function storeProspect()
    {


        $newAddress = new Address;

        $newAddress->province = request('provinsi');
        $newAddress->city = request('kota');
        $newAddress->kelurahan = request('kelurahan');
        $newAddress->district = request('kecamatan');
        $newAddress->postal_code = request('kodePos');
        $newAddress->street = request('namaJalan');
        $newAddress->save();

        // $sizeAddress = sizeof(Address::select('id')->get());
        $newProspect = new Prospect;
        $newProspect->prospect_willingness_id = 3;
        $newProspect->customer_type_id = 1;
        $newProspect->customer_id = request('id_customer');
        $newProspect->notes = request('notes');
        // $newProspect->address_id =  $sizeAddress + 1;
        $newProspect -> address() -> associate($newAddress);
        $newProspect->save();

        Customer::where('id', request('id_customer')) ->update(['is_act'=>true]);
        return redirect()->route('list_customers');

    }

    public function store_csv(Request $req){
        $tmpName = $req->file('file_csv')->getPathName();
        // dd($req);
        $csvAsArray = array_map('str_getcsv', file($tmpName));
        // dd($csvAsArray);

        foreach ($csvAsArray as $value) {
            //$validatedData = $request->validate([$value[1] => 'required|unique:telephones,telp_no']);

            $newCust = new Customer;

            $newCust->name = $value[0];
            $newCust->is_act = 0;
            $newCust->pic_sp_id = Auth::user()->id;
            $newCust->save();

            $newTelp = new Telephone;

            $newTelp->telp_no = $value[1];
            $newTelp-> Customer() -> associate($newCust);
            $newTelp->save();
        }
        return redirect()->route('list_customers');
    }

    public function store_response_ex_cust() {
        if (request ('customer_type') == "Pending") {
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
            $strSch -> scheduleType() -> associate($strScTp);
            // $strSch->id_schedule_types = sizeof(ScheduleType::select('id')->get());
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Customer::where('id', request('id_customer')) ->update(['is_act'=>true]);
            return redirect()->route('list_customers');
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
            $strSch->notes = request('notes');
            $strSch -> scheduleType() -> associate($strScTp);
//            $strSch->id_schedule_types = sizeof(ScheduleType::select('id')->get());
            $strSch->id_customer = request('id_customer');
            $strSch->id_user_sp = $id;
            $strSch->save();

            Customer::where('id', request('id_customer')) ->update(['is_act'=>true]);
            return redirect()->route('list_customers');
        }
    }
}
