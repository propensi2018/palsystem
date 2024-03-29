<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospect;
use App\Customer;
use App\ProspectWillingness;
use App\Address;
use App\CustomerType;
use App\Schedule;
use App\ScheduleType;
use App\Appointment;
use App\ProductList;
use App\ProductListAssoc;
use App\ProductType;
use App\User;
use App\Telephone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
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
        $today1 = date('Y-m-d');
        $today2 = date('H:i');
        $today = $today1.'T'.$today2;
        $scheduleDeal=DB::table('schedules')
            ->join('product_lists','schedule_id','=','schedules.id')
            ->join('transactions' , 'id_pl','=','product_lists.id')
            ->join('product_list_assocs','product_list_id','=','product_lists.id')
            ->join('product_types','id_ptype','=','product_types.id')
            ->where([['id_customer',$id],['is_valid',1]] )
            ->orderBy('schedules.created_at','desc')->get();
        
        if(sizeof($scheduleDeal)!=0){
        $tanggalSchedule = Schedule::where('id',$scheduleDeal[0]->schedule_id)->get();
        }
        else{
            
        }
        
        $scheduleDealSaja=DB::table('schedules')
            ->join('product_lists','schedule_id','=','schedules.id')
            ->join('product_list_assocs','product_list_id','=','product_lists.id')
            ->join('product_types','id_ptype','=','product_types.id')
            ->leftJoin('transactions' , 'id_pl','=','product_lists.id')
            ->where([['id_customer',$id],['is_valid',null]] )
            ->orderBy('schedules.created_at','desc')->get();

        if(sizeof($scheduleDealSaja)!=0){
        $tanggalScheduleSaja = Schedule::where('id',$scheduleDealSaja[0]->schedule_id)->get();
        
        }
        else{
            
        }
        $scheduleBelumDeal=DB::table('schedules')
            ->join('product_lists','schedule_id','=','schedules.id')
            ->join('transactions' , 'id_pl','=','product_lists.id')
            ->join('product_list_assocs','product_list_id','=','product_lists.id')
            ->join('product_types','id_ptype','=','product_types.id')
            ->where([['id_customer',$id],['is_valid',0]] )
            ->orderBy('schedules.created_at','desc')->get();
     
        $customerData = Customer::find($id);
        if($customerData!= null){
        $telepon = Telephone::where('customer_id' , $customerData->id)->get();
        $prospect = Prospect::where('customer_id', $id) -> get();
        $addressProspect = Address::where('prospect_customer_id' , $id)->get();
        $prospectWillingnessId = $prospect[0] ->prospect_willingness_id;
        $pw = ProspectWillingness::find($prospectWillingnessId);
        $customerTypeId = $prospect[0] -> customer_type_id;
        $customerType = CustomerType::find($customerTypeId);
        $customerSchedule = Schedule::where('id_customer',$id)->get();
       
        $allSchedule = Schedule::where([['schedules.id_customer' , $id],['is_done',0]])->get();
    

    }
        else{
            abort(404);
        }

        return view('profile-prospect',  compact('prospect','customerData','pw','telepon','customerType','customerSchedule','productListAssoc','productType','prospectTypeProdukDesc','productListAmount','addressProspect','scheduleAppointmentId','scheduleDeal','today','scheduleSkrg','allSchedule','scheduleDealSaja','tanggalSchedule','tanggalScheduleSaja','scheduleBelumDeal'));
 // return compact('scheduleDeal','scheduleDealSaja');
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
    public function updateWillingness()
    {
        $id = request('id_willingness');
        Prospect::where('customer_id' , $id)->update(['prospect_willingness_id'=>request('prospect_willingness')]);
        return redirect() ->route('profile-prospect', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function store_response_ex_cust(Request $request) {
        
        $id = Auth::id();
        if (request ('customer_type') == "Appointment") {
            $strApp = new Appointment();
            $strApp ->is_a_deal = 0;
            $strApp ->id_act_type = 1;
            $strApp->save();
            
            $strScTp = new ScheduleType;
            $strScTp->telp_flag = 1;
            $strScTp->save();

            $strSch = new Schedule;
            $strSch->is_done = 0;
            $strSch->time = request('time');
            $strSch->notes = request('notes');
            $strSch -> scheduleType() -> associate($strScTp);
            $strSch -> cycle = request('cycleCust');
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
