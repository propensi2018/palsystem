<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticType extends Model
{


  //RETURN object the statistic is evaluating
  public function evaluatee() {
    $returner = $this -> salesperson();
    if(!empty((array) $returner)) {
      return $returner;
    } else {
      $returner = $this -> level();
      if(!empty((array) $returner)) {
        return $returner;
      } else {
        $returner = $this -> productType();
        return $returner;
      }
    }
  }
  public function id_evaluatee() {
    $returner = $this -> id_user_sp;
    if($returner != null) {
      return [$returner, 'salespeople'];
    } else {
      $returner = $this -> id_level;
      if($returner != null)) {
        return [$returner, 'levels'];
      } else {
        $returner = $this -> id_product;
        return [$returner, 'product_types'];
      }
    }
  }
  protected function salesperson(){
      return $this->belongsTo(Salesperson::class);
  }
  protected function level(){
      return $this->belongsTo(Level::class);
  }
  protected function productType(){
      return $this->belongsTo(ProductType::class);
  }

}
