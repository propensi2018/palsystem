<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function productList() {
      return $this->belongsTo(ProductList::class);
    }

    public function date() {
      return $this -> created_at;
    }

    public function setTarget($target)
    {
      $this -> target = $target;
      $this -> save();
    }

    public function setYear($year)
    {
      $this -> end_date = "31/12/" . $year;
      $this -> save();
    }

    public function getYear(){
      return $this-> end_date-> format("Y");
    }

}
