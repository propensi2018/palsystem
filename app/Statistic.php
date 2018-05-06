<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
  /*
  return the amount of product sold in the month and date
  */
  protected function calculateProduct($month, $year, $product_type_id) {
    $amounts = DB::table('transactions')
    ->join('product_lists', 'transactions.id_pl', '=', 'product_lists.id')
    ->join('product_list_assocs', 'product_lists.id', '=', 'product_list_assocs.product_list_id')
    ->where('product_list_assocs.id_ptype', '=', $product_type_id)
    ->where('created_at', '>=', $year . "-" . $month . "-1 00:00:00")
    ->where('created_at', '<', $year . "-" . ($month + 1) . "-1 00:00:00")
    ->select('amount');
    return $amounts -> sum();
  }

  /*
  return the set of labels needed by the chart.js
  */
  public function returnLabels() {
    date_default_timezone_set("Asia/Bangkok");
    $m = date('m');
    $array = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $returner = []
    for ($i = 0; i < $m; $i++) {
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

    for ($i = 0 , $i < $m; $i++) {
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
