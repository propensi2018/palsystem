<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Statistic extends Model
{
  /*
  return product data for the current year
  author : farhannp
  */
  public function product_data() {
    $all_ptype = ProductType::all();
    $returner = array();
    foreach ($all_ptype as $product) {
      array_push($returner, $this -> product_data_set($product -> id, "rgb(". rand(0,255).", ".rand(0,255).", ".rand(0,255).")"));
    }
    return $returner;
  }

  /*
  author : farhannp
  return the amount of product sold in the month and date
  sample return
  {
      data: [86,114,106,106,107,111,133,221,783,2478],
      label: "Africa",
      borderColor: "#3e95cd",
      fill: '-1'
    }
    $statistic = New Statistic;
    // $statistic -> calculateProduct(6,2018,3);
  */
  protected function product_data_set($product_id, $color) {
    date_default_timezone_set("Asia/Bangkok");
    // $m = date('m');
    $y = date('y');
    $labels = $this -> returnLabels();
    $dataset = new Dataset;
    $dataset -> label = ProductType::find($product_id) -> desc;
    $dataset -> borderColor = $color;

    $data = array();
    $current = 0;
    $i = 1;
    foreach ($labels as $label) {
      $current += $this -> calculateProduct($i, $y, $product_id);
      array_push($data, $current);
      $i++;
    }
    $dataset -> data = $data;

    return $dataset;
  }

  /*
  calucate the amount of product given year month and porduct // IDEA:
  */
  public function calculateProduct($month, $year, $product_type_id) {
    $amounts = DB::table('transactions')
    ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
    ->join('product_list_assocs', 'product_lists.id', '=', 'product_list_assocs.product_list_id')
    ->where('product_list_assocs.id_ptype', '=', $product_type_id)
    ->where('product_list_assocs.created_at', '>=', $year . "-" . $month . "-1 00:00:00")
    ->where('product_list_assocs.created_at', '<', $year . "-" . ($month + 1) . "-1 00:00:00")
    ->select('amount')->get();

    return $amounts -> sum('amount');
  }

  /*
  calucate the amount of product given year month and porduct // IDEA:
  */
  public function calculateProduct($year, $product_type_id) {
    $amounts = DB::table('transactions')
    ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
    ->join('product_list_assocs', 'product_lists.id', '=', 'product_list_assocs.product_list_id')
    ->where('product_list_assocs.id_ptype', '=', $product_type_id)
    ->where('product_list_assocs.created_at', '>=', $year . "-" . "01" . "-1 00:00:00")
    ->where('product_list_assocs.created_at', '<', $year + 1 . "-" . "01" . "-1 00:00:00")
    ->select('amount')->get();

    return $amounts -> sum('amount');
  }

  /*
  return the set of labels needed by the chart.js
  */
  public function returnLabels() {
    date_default_timezone_set("Asia/Bangkok");
    $m = date('m');
    $array = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $returner = [];
    for ($i = 0; $i < $m; $i++) {
      array_push($returner, $array[$i]);
    }
    return $returner;

  }

  /*
  return an array of production of the month
  */
  public function calculateYear($year, $product_type_id) {
    date_default_timezone_set("Asia/Bangkok");
    $m = date('m');
    // return $today1;
    $returner = array();

    for ($i = 0 ; $i < $m; $i++) {
      array_push($returner, calculateProduct($i, $year, $product_type_id));
    }

    return $returner;
  }

  public function statisticType()
  {
      return $this->belongsTo(StatisticType::class);
  }

  protected function evaluatee(){
    return $this->statisticType()->id_evaluatee();
  }

  public function json() {

  }

public function statisticSalesperson($month, $year,$id)
    {

    $statistik = DB::table('product_lists')
        ->select('amount')
        ->join('schedules','schedule_id','=','schedules.id')
        ->join('transactions','id_pl','=','product_lists.id')
        ->join('product_list_assocs','product_list_id','=','product_lists.id')
        ->where('schedules.id_user_sp' , $id)
        ->where('product_list_assocs.created_at', '>=', $year . "-" . $month . "-1 00:00:00")
        ->where('product_list_assocs.created_at', '<', $year . "-" . ($month + 1) . "-1 00:00:00")
        ->get();

        return $statistik -> sum('amount');
    }
public function statisticSalespersonAll($month, $year,$id)
    {

    $statistik = DB::table('product_lists')
        ->select('amount')
        ->join('schedules','schedule_id','=','schedules.id')
        ->join('transactions','id_pl','=','product_lists.id')
        ->join('product_list_assocs','product_list_id','=','product_lists.id')
        ->where('product_list_assocs.created_at', '>=', $year . "-" . $month . "-1 00:00:00")
        ->where('product_list_assocs.created_at', '<', $year . "-" . ($month + 1) . "-1 00:00:00")
        ->get();


        return $statistik -> sum('amount');
    }

 protected function sales_set_data($id, $color) {
        date_default_timezone_set("Asia/Bangkok");
        $y = date('y');
        $labels = $this -> returnLabels();
        $dataset = new Dataset;
        $dataset -> label =  User::find($id) -> name;
        $dataset -> borderColor = $color;
        $data = array();
        $current = 0;
        $i = 1;
        foreach ($labels as $label) {
            $current += $this -> statisticSalesperson ($i, $y,$id);
            array_push($data, $current);
            $i++;
            }
            $dataset -> data = $data;

        return $dataset;
          }
public function sales_data($id) {
        $salesperson = User::find($id);
        $salespersonAll = User::all()->where('is_sp' , 1);
        if($salesperson->is_sp == 1)
        {
        $returner = array();
        array_push($returner, $this -> sales_set_data($id, "rgb(". rand(0,255).", ".rand(0,255).", ".rand(0,255).")"));
        }
        else
        {
            $returner = array();
                foreach ($salespersonAll as $all_sales) {
                array_push($returner, $this -> sales_set_data($all_sales ->id, "rgb(". rand(0,255).", ".rand(0,255).", ".rand(0,255).")"));
    }

        }
        return $returner;
  }


}
