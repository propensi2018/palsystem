<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Statistic extends Model
{

  public function product_data() {
    $all_ptype = ProductType::all();
    $returner = array();
    foreach ($all_ptype as $product) {
      array_push($returner, $this -> product_data_set($product -> id, ""));
    }
    return $returner;
  }

  /*
  return the amount of product sold in the month and date
  sample return
  {
      data: [86,114,106,106,107,111,133,221,783,2478],
      label: "Africa",
      borderColor: "#3e95cd",
      fill: '-1'
    }
  */
  protected function product_data_set($product_id, $color) {
    date_default_timezone_set("Asia/Bangkok");
    // $m = date('m');
    $y = date('y');
    $labels = $this -> returnLabels();
    $dataset = new Dataset;
    $dataset -> label = ProductType::find($product_id) -> desc;
    $dataset -> backgroundColor = $color;

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

  public function calculateProduct($month, $year, $product_type_id) {
    $amounts = DB::table('transactions')
    ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
    ->join('product_list_assocs', 'product_lists.id', '=', 'product_list_assocs.product_list_id')
    ->where('product_list_assocs.id_ptype', '=', $product_type_id)
    ->where('product_list_assocs.created_at', '>=', $year . "-" . $month . "-1 00:00:00")
    ->where('product_list_assocs.created_at', '<', $year . "-" . ($month + 1) . "-1 00:00:00")
    ->select('amount')->get();
    // return $amounts;
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

}
