<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticType extends Model
{

  // to do create attribute and documentation for what is that
  // public function evaluatee() {
  //   if($this -> type === 1) {
  //     return salesperson();
  //   } else if ($this -> type === 2) {
  //     return level();
  //   } else {
  //     return productType();
  //   }
  // }

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


  protected function salesperson()
  {
      return $this->belongsTo(Salesperson::class);
  }
  protected function level()
  {
      return $this->belongsTo(Level::class);
  }
  protected function productType()
  {
      return $this->belongsTo(ProductType::class);
  }
  // public function productList()
  // {
  //     return $this->hasOne(ProductList::class);
  // }
}
