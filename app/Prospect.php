<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $primaryKey = 'customer_id';
    //Prospect dimiliki oleh customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function prospectWillingess()
    {
        return $this->hasOne(ProspectWillingness::class);
    }
     public function prospectAddress()
    {
        return $this->hasOne(Address::class);
    }
    public function prospectCustomerType()
    {
        return $this->hasOne(CustomerType::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
}
