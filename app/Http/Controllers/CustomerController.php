<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospect;
use App\Customer;
use App\ProspectWillingness;
use App\Address;
use App\CustomerType;
use App\Schedule;
use App\ProductList;
use App\ProductListAssoc;
use App\ProductType;
use Illuminate\Support\Facades\DB;

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
        $customerData = Customer::find($id);
        $prospect = Prospect::where('customer_id', $id) -> get();
        $prospectNotes = $prospect[0]->notes;
        $prospectWillingnessId = $prospect[0] ->prospect_willingness_id;
        $pw = ProspectWillingness::find($prospectWillingnessId);
        $prospectAddressId = $prospect[0] -> address_id;
        $prospectAddress= Address::find($prospectAddressId);
        $customerTypeId = $prospect[0] -> customer_type_id;
        $customerType = CustomerType::find($customerTypeId);
        $customerSchedule = Schedule::where('id_customer',$id)->get();
        $joinSchedule =DB::table('product_lists')->leftJoin('schedules','schedule_id','=','schedules.id')->where('schedules.id_customer' , $id)->get();
        $productListId = $customerSchedule[0]-> id;
        $temp = array();
        $tempProductType=array();
        $productList = ProductList::find($productListId); 
        $jumlahProduct = sizeof($joinSchedule);
        $kumpulanTemp = array();        
        for($i=0;$i<$jumlahProduct;$i++)
        {

            $productListSemua = array();
            $productListAssoc = array();
            $productListType = array();
            $productListCustomer = array();    
            array_push($productListSemua, $joinSchedule[$i]->id); 
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
                                    'dataTypeProduct' => $plt);
                
                array_push($kumpulanTemp, $temp);
            }else{
                
            }
          
                                   
        }
            
    return view('profile-prospect' ,  compact('prospectNotes','customerData','pw','prospectAddress','customerType','customerSchedule','productList','productListAssoc','productType','prospectTypeProdukDesc','productListAmount','kumpulanTemp'));
  //  return compact('tempu');


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
