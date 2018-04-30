<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Http\Resources\Transaction as TransactionResource;


class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect()->route('profile-prospect', ['id_customer' => request('id_customer')]);
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
        $uniqueCode = $request->code;
        $is_exist = $this->checkExist($uniqueCode);
        while($is_exist){
            $uniqueCode = $this->genRandStr();
            $is_exist = $this->checkExist($uniqueCode);
        }
        return $this->save($uniqueCode);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pemesanan', ['transaction' => Transaction::findOrFail($id)]);
    }

    public function check($code)
    {
        $transaction =  new TransactionResource(Transaction::where('code', $code)->first());
        $trn = (array)$transaction;
        if(empty($trn['resource'])) {
            $exist = "Unique Code Doesn't Exist";
        } else {
            $exist = "Unique Code Exist";
            $uniqueCode = $transaction['code'];
            $productSolds = DB::table('transactions')
                    ->join('product_list_assocs','transactions.id_pl', '=', 'product_list_assocs.product_list_id')
                    ->join('product_types','product_list_assocs.id_ptype', '=', 'product_types.id')
                    ->where('transactions.code', $uniqueCode)
                    ->select('transactions.code','product_types.desc','product_list_assocs.amount')
                    ->get();
            return response()->json($productSolds);

            DB::table('transactions')
                ->where('code', $uniqueCode)
                ->update(['is_valid' => 1]);

            //$id_pl = DB::table('transactions')->where('code', $uniqueCode)->value('id_pl');
            //$schedule_id = DB::table('product_lists')->where('id', $id_pl)->value('schedule_id');
            //$schedule_type_id = DB::table('schedules')->where('id', $schedule_id)->value('schedule_type_id');
            //$appointment_id = DB::table('schedule_types')->where('id', $schedule_type_id)->value('appointment_id');

            $appointment_id = DB::table('transactions')
                ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
                ->join('schedules', 'product_lists.schedule_id', '=', 'schedules.id')
                ->join('schedule_types', 'schedules.schedule_type_id', '=', 'schedule_types.id')
                ->where('transactions.code', $uniqueCode)
                ->value('appointment_id');

            DB::table('appointments')
                ->where('id', $appointment_id)
                ->update(['is_a_deal' => 1]);


        }
        return response()->json($exist);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_all()
    {
        //$transactions = DB::table('transactions')->get();

        return view('all_pemesanan', ['transactions' => Transaction::all()]);
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

    public function generateUniqueCode(Request $request)
    {
      $id_pl =  $request -> id_pl;
      $id_customer =  $request -> id_customer;
       $uniqueCode = $this->genRandStr();
        $is_exist = $this->checkExist($uniqueCode);
        while($is_exist){
            $uniqueCode = $this->genRandStr();
            $is_exist = $this->checkExist($uniqueCode);
        }
        return $this->save($uniqueCode, $id_pl, $id_customer);
        // return route();

    }

    public function checkExist($code)
    {
        if (Transaction::where('code', '=', $code)->exists()) {
            return true;
        }
        return false;
    }

    public function genRandStr(){
      $a = $b = '';

      for($i = 0; $i < 3; $i++){
        $a .= chr(mt_rand(65, 90)); // see the ascii table why 65 to 90.
        $b .= mt_rand(0, 9);
      }

      return $a . $b;
    }

    public function save($uniqueCode, $id_pl, $id_customer)
    {
        $transaction = new Transaction;

        $transaction->code = $uniqueCode;
        $transaction->is_valid = "1";
        $transaction->id_pl = $id_pl;

        $transaction -> save();

        return view('hasilForm_pemesanan', ['transaction' => $transaction, 'id_customer' => $id_customer]);
    }
}
