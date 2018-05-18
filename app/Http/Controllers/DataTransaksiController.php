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
use App\Branch;
use App\Telephone;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use PDF;

class DataTransaksiController extends Controller
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
    public function printPDF(Request $req)
    {
        $user =Auth::user();
        //return $user;                                                                                                
        $id = $user-> id;
        //return $id;
        // dd($req);

        $allYear = DB::table('transactions')->select('updated_at')->distinct()->get();//->updated_at;
        $yearArray =array();

        foreach($allYear as $year) {
            $a = substr($year->updated_at,0,4);
            if(!in_array($a, $yearArray)){
                array_push($yearArray, $a);
            }
        }

        if (!empty($req->month) && !empty($req->year) && $req->month!="All") {
            // $from = $req->month . "-01-" . $req->year;
            $from = date("Y-m-01", mktime(0,0,0,$req->month, 1, $req->year));
            $until = date("Y-m-t", mktime(0,0,0,$req->month, 1, $req->year));

            $id_branch = Branch::where('mgr_user_id', $user->id)->get()->first()->level_id;
            //return $id_branch;
            $TransData=DB::table('transactions')
            ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
            ->join('schedules', 'product_lists.schedule_id', '=', 'schedules.id')
            ->join('customers', 'schedules.id_customer', '=', 'customers.id')
            ->join('prospects', 'customers.id','=','prospects.customer_id')
            ->join('addresses', 'prospects.customer_id','=','addresses.prospect_customer_id')
            ->join('product_list_assocs', 'product_lists.id','=','product_list_assocs.product_list_id')
            ->join('product_types', 'product_list_assocs.id_ptype','=','product_types.id')
            ->join('salespeople','schedules.id_user_sp','=','salespeople.user_id')
            // ->join('users','schedules.id_user_sp','=','users.id')
            ->where('salespeople.branch_level_id','=', $id_branch)
            // ->join('levels','branches.level_id','=','levels.id')
            //->join('telephones','customers.id','=','telephones.customer_id')
            ->where('transactions.is_valid', '=', '1')
            // ->orWhere('users.is_sp', '=', '0')
            // ->orWhere('branches.mgr_user_id', '=', $id) 
            ->whereBetween("transactions.created_at", [$from, $until])
            // ->select('product_lists.id as id_pl', 'schedules.id_customer as customer_id', 'product_list_assocs.id_ptype as prod_id')
            ->get();
            //return $TransData;
            
        } else  {
             $id_branch = Branch::where('mgr_user_id', $user->id)->get()->first()->level_id;

            $TransData=DB::table('transactions')
            ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
            ->join('schedules', 'product_lists.schedule_id', '=', 'schedules.id')
            ->join('customers', 'schedules.id_customer', '=', 'customers.id')
            ->join('prospects', 'customers.id','=','prospects.customer_id')
            ->join('addresses', 'prospects.customer_id','=','addresses.prospect_customer_id')
            ->join('product_list_assocs', 'product_lists.id','=','product_list_assocs.product_list_id')
            ->join('product_types', 'product_list_assocs.id_ptype','=','product_types.id')
            ->join('salespeople','schedules.id_user_sp','=','salespeople.user_id')
            // ->join('users','schedules.id_user_sp','=','users.id')
            ->where('salespeople.branch_level_id','=', $id_branch)
            // ->join('levels','branches.level_id','=','levels.id')
            //->join('telephones','customers.id','=','telephones.customer_id')
            ->where('transactions.is_valid', '=', '1')
            // ->orWhere('users.is_sp', '=', '0')
            // ->orWhere('branches.mgr_user_id', '=', $id) 
            ->get();
            //return $TransData;
        }

        foreach ($TransData as $singleData) {
            $telephones = DB::table ('telephones')->where('customer_id', $singleData -> customer_id)->select('telp_no')->get();
            $singleData -> telephones = $telephones;
        }

        $pdf = PDF::loadView('print_PDF', ['TransData' => $TransData, 'month' => $req->month, 'year' => $req->year]);

        return $pdf->stream('Transaction-data.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        $user =Auth::user();
        //return $user;                                                                                                
        $id = $user-> id;
        //return $id;
        // dd($req);

        $allYear = DB::table('transactions')->select('updated_at')->distinct()->get();//->updated_at;
        $yearArray =array();

        foreach($allYear as $year) {
            $a = substr($year->updated_at,0,4);
            if(!in_array($a, $yearArray)){
                array_push($yearArray, $a);
            }
        }

        if (!empty($req->month) && !empty($req->year) && $req->month!="All") {
            // $from = $req->month . "-01-" . $req->year;
            $from = date("Y-m-01", mktime(0,0,0,$req->month, 1, $req->year));
            $until = date("Y-m-t", mktime(0,0,0,$req->month, 1, $req->year));

            $id_branch = Branch::where('mgr_user_id', $user->id)->get()->first()->level_id;
            //return $id_branch;
            $TransData=DB::table('transactions')
            ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
            ->join('schedules', 'product_lists.schedule_id', '=', 'schedules.id')
            ->join('customers', 'schedules.id_customer', '=', 'customers.id')
            ->join('prospects', 'customers.id','=','prospects.customer_id')
            ->join('addresses', 'prospects.customer_id','=','addresses.prospect_customer_id')
            ->join('product_list_assocs', 'product_lists.id','=','product_list_assocs.product_list_id')
            ->join('product_types', 'product_list_assocs.id_ptype','=','product_types.id')
            ->join('salespeople','schedules.id_user_sp','=','salespeople.user_id')
            // ->join('users','schedules.id_user_sp','=','users.id')
            ->where('salespeople.branch_level_id','=', $id_branch)
            // ->join('levels','branches.level_id','=','levels.id')
            //->join('telephones','customers.id','=','telephones.customer_id')
            ->where('transactions.is_valid', '=', '1')
            // ->orWhere('users.is_sp', '=', '0')
            // ->orWhere('branches.mgr_user_id', '=', $id) 
            ->whereBetween("transactions.created_at", [$from, $until])
            // ->select('product_lists.id as id_pl', 'schedules.id_customer as customer_id', 'product_list_assocs.id_ptype as prod_id')
            ->get();
            //return $TransData;

            
        } else  { // kalo gaada tanggalnya
            $id_branch = Branch::where('mgr_user_id', $user->id)->get()->first()->level_id;

            $TransData=DB::table('transactions')
            ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
            ->join('schedules', 'product_lists.schedule_id', '=', 'schedules.id')
            ->join('customers', 'schedules.id_customer', '=', 'customers.id')
            ->join('prospects', 'customers.id','=','prospects.customer_id')
            ->join('addresses', 'prospects.customer_id','=','addresses.prospect_customer_id')
            ->join('product_list_assocs', 'product_lists.id','=','product_list_assocs.product_list_id')
            ->join('product_types', 'product_list_assocs.id_ptype','=','product_types.id')
            ->join('salespeople','schedules.id_user_sp','=','salespeople.user_id')
            // ->join('users','schedules.id_user_sp','=','users.id')
            ->where('salespeople.branch_level_id','=', $id_branch)
            // ->join('levels','branches.level_id','=','levels.id')
            //->join('telephones','customers.id','=','telephones.customer_id')
            ->where('transactions.is_valid', '=', '1')
            // ->orWhere('users.is_sp', '=', '0')
            // ->orWhere('branches.mgr_user_id', '=', $id) 
            ->get();
            //return $TransData;
        }

            
        // return $TransData;
        // $returner = array();
        // $index = 0;
        // $indexObject = "";
        // foreach($TransData as $singleData) {
        //   if ($singleData -> customer_id == $index) {
        //     $indexObject -> telp_no = $indexObject -> telp_no . " , " .  $singleData -> telp_no;
        //   } else {
        //   array_push($returner, $singleData);
        //   $index = $singleData -> customer_id;
        //   $indexObject = $singleData;
        //   }
        // }
        //return $returner;

        foreach ($TransData as $singleData) {
            $telephones = DB::table ('telephones')->where('customer_id', $singleData -> customer_id)->select('telp_no')->get();
            $singleData -> telephones = $telephones;
        }
        //return $TransData;
        // $getAmount = '';
        // for($i=0;$i<sizeof($TransData);$i++) {
        //     $getAmount = $TransData[$i] -> amount;

        //     $sizeAmount = strlen($getAmount);
            
        //     $lastAmount = $sizeAmount % 3;
        //     $amountLength = floor($sizeAmount / 3);

        //     $substr = '';

        //     $indexDot = 3;
        //     $indexStr = 0;
        //     for($j=0; $j<$amountLength; $j++) {
        //         if ($lastAmount == 0 && $j+1 != $amountLength) {
        //             $substr .= substr($getAmount, $indexStr, $indexDot). '.';
        //         } else if ($lastAmount == 0 && $j+1 == $amountLength) {
        //             $substr .= substr($getAmount, $indexStr, $indexDot);
        //         }
        //         if ($lastAmount == 2 && $j == 0) {
        //             $substr .= substr($getAmount, $indexStr, 2). '.';
        //             $indexStr = $indexStr - 1;
        //             $amountLength = $amountLength +1;
        //         } elseif ($lastAmount == 2 && $j != 0 && $j+1 < $amountLength) {
        //             $substr .= substr($getAmount, $indexStr, $indexDot). '.';
        //         } elseif ($lastAmount == 2 && $j != 0 && $j+1 == $amountLength) {
        //             $substr .= substr($getAmount, $indexStr, $indexDot);
        //         }
        //         if ($lastAmount == 1 && $j == 0) {
        //             $substr .= substr($getAmount, $indexStr, 1). '.';
        //             $indexStr = $indexStr - 2;
        //             $amountLength = $amountLength +1;
        //         } elseif ($lastAmount == 1 && $j != 0 && $j+1 < $amountLength) {
        //             $substr .= substr($getAmount, $indexStr, $indexDot). '.';
        //         } elseif ($lastAmount == 1 && $j != 0 && $j+1 == $amountLength) {
        //             $substr .= substr($getAmount, $indexStr, $indexDot);
        //         }
        //         $indexStr = $indexStr + 3;
        //     }
        // }
        return view('data_transaksi', ['TransData' => $TransData, 'month' => $req->month, 'year' => $req->year], ['yearArray' => $yearArray]);

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
