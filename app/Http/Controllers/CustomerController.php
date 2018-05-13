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
//        $appointmentDeal =  $scheduleDeal=DB::table('schedules')
//            ->join('schedule_types','schedule_type_id','=','schedule_types.id')
//            ->join('appointments' , 'appointments.id','=','schedule_types.appointment_id')
//            ->where('id_customer',$id )
//            ->orderBy('schedule_types.created_at','desc')->get();
       
       $scheduleDeal=DB::table('schedules')
            ->join('schedule_types','schedule_type_id','=','schedule_types.id')
            ->join('appointments' , 'appointments.id','=','schedule_types.appointment_id')
            ->where([['id_customer',$id],['is_a_deal' ,1]] )
            ->orderBy('schedule_types.created_at','desc')->get();
            
           
//        $scheduleTypeDeal = DB::table('schedule_types')
//            ->join()
        $customerData = Customer::find($id);
        $prospect = Prospect::where('customer_id', $id) -> get();
        $addressProspect = Address::where('prospect_customer_id' , $id)->get();
        $prospectNotes = $prospect[0]->notes;
        $prospectWillingnessId = $prospect[0] ->prospect_willingness_id;
        $pw = ProspectWillingness::find($prospectWillingnessId);
        $prospectAddressId = $prospect[0] -> address_id;
        $prospectAddress= Address::find($prospectAddressId);
        $customerTypeId = $prospect[0] -> customer_type_id;
        $customerType = CustomerType::find($customerTypeId);
        $customerSchedule = Schedule::where('id_customer',$id)->get();
        $joinSchedule =DB::table('product_lists')->join('schedules','schedule_id','=','schedules.id')->where('schedules.id_customer' , $id)->get();
       
        $allSchedule = Schedule::where([['schedules.id_customer' , $id],['is_done',1]])->get();
  
        if(sizeof($allSchedule)!=0){
        $jumlahSchedule = sizeof($allSchedule);
        if($jumlahSchedule!=0){
        $scheduleTypeId  = ScheduleType::where('id',$allSchedule[$jumlahSchedule-1]->schedule_type_id)->get();
        
      
        $scheduleAppointmentId = Appointment::where('id',$scheduleTypeId[0]->appointment_id)->get();
        }
        else{
          $scheduleTypeId  = ScheduleType::where('id',$allSchedule[0]->schedule_type_id)->get();
        $scheduleAppointmentId = Appointment::where('id',$scheduleTypeId[0]->appointment_id)->get();   
        }
        }
        else{
            $allSchedule = Schedule::where('schedules.id_customer' , $id)->get();
            $scheduleTypeId  = ScheduleType::where('id',$allSchedule[0]->schedule_type_id)->get();
            $scheduleAppointmentId = Appointment::where('id',$scheduleTypeId[0]->appointment_id)->get();  
            
        }
        $productListId = $customerSchedule[0]-> id;
        $temp = array();
        $tempProductType=array();
        $productList = ProductList::find($productListId); 
        $jumlahProduct = sizeof($joinSchedule);
        $kumpulanTemp = array();       
        $scheduleType = array();
        $scheduleAppointment = array();
        for($i=0;$i<$jumlahProduct;$i++)
        {   

            $productListSemua = array();
            $productListAssoc = array();
            $productListType = array();
            $productListCustomer = array();    
            array_push($productListSemua, $joinSchedule[$i]->id);  
           array_push($scheduleType , ScheduleType::where('id',$joinSchedule[$i]->schedule_type_id)->get()->first());
       
//            array_push($scheduleType , $joinType = DB::table('schedules')
//            ->join('schedule_types','schedule_type_id','=','schedule_types.id')
//            ->where([['id_customer',$id],['schedule_types.id' ,$joinSchedule[$i]->schedule_type_id ])
//            ->orderBy('schedule_types.created_at','desc')->get()->first());
            array_push($scheduleAppointment ,Appointment::where('id',$scheduleType[$i]->appointment_id)->get());
           
            array_push($productListCustomer , ProductList::where('schedule_id' , $productListSemua[0])->get()->first());
            if($productListCustomer[0] !=null){
                array_push($productListAssoc , ProductListAssoc::where('product_list_id',$productListCustomer[0]->id)->get()); 
                $plt = array();
                foreach($productListAssoc[0] as $pla) {
                array_push($plt , ProductType::where('id',$pla->id_ptype)->get()->first());
                }
                
                 $temp = array(     'dataJumlahProduct' => $productListSemua[0],
                                    'dataAmountProduct' => $productListAssoc[0],
                                    'dataProductList' => $productListCustomer[0],
                                   'dataAppointment' => $scheduleAppointment[$i],
                                    'dataScheduleType' => $scheduleType[$i],
                                    'dataTypeProduct' => $plt);
                
                array_push($kumpulanTemp, $temp);
               
            }else{
                
            }
          
                                   
        }
//return [$kumpulanTemp];
return view('profile-prospect',  compact('prospect','prospectNotes','customerData','pw','prospectAddress','customerType','customerSchedule','productList','productListAssoc','productType','prospectTypeProdukDesc','productListAmount','kumpulanTemp','addressProspect','scheduleAppointmentId','scheduleDeal','joinSchedule'));
//  return compact('kumpulanTemp');


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
    public function showStatistik()
    {
         $id = Auth::id();
         $user  = User::find($id);
        if($user == null){
            
        }
        else
        {
           
         if($user -> is_sp == 1){
                
             $statistik = DB::table('product_lists')
            ->join('schedules','schedule_id','=','schedules.id')
            ->join('transactions','id_pl','=','product_lists.id')
            ->join('product_list_assocs','product_list_id','=','product_lists.id')
            ->where('schedules.id_user_sp' , $id)
            ->sum('amount');
        
      
         }
            else{
            $statistik = DB::table('product_lists')
            ->select('amount','id_user_sp')
            ->join('schedules','schedule_id','=','schedules.id')
            ->join('transactions','id_pl','=','product_lists.id')
            ->join('product_list_assocs','product_list_id','=','product_lists.id')
            ->get();
             
            }
       
        }
    
        
    }
}
