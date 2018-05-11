<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\MessageReceived;
use App\Rating;
use App\Message;
use App\Salesperson;
use App\Branch;
use App\Region;
use App\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\File;
use DateTime;


class RewardController extends Controller
{
  public function compareSalesperson(){
    date_default_timezone_set("Asia/Bangkok");
    $date = date('d-m');
    $input = '7'; //best performance Salesperson user id

    //add reward
    if($date == '07-05'){
        $currentYear = date("y");

        if(sizeof(Rating::All()) !== 0){
        $latestYear = substr((Rating::select('date')->orderBy('date','desc')->first()->date),2,2);
      }else{
        $latestYear = 0;
      }

      if($currentYear !== $latestYear ){
        if((Rating::select('score')->where('sales_user_id',$input)->get()->first()) == null){
          $newReward = new Rating;
          $newReward->sales_user_id = $input;
          $newReward->date = new DateTime();
          $newReward->score = 1;
          $newReward->save();
        }
        else{
           $currentScore = Rating::select('score')->where('sales_user_id',$input)->get()->first()->score;
           $newReward = new Rating;
           $newReward->sales_user_id = $input;
           $newReward->date = new DateTime();
           $newReward->score = $currentScore+1;
           $newReward->save();
        }
      }
    }
    //set reward to UI
    $id = Auth::id();
    $user = User::find($id);
    $rewardedSp = $user -> Rating;


    if((Rating::where('sales_user_id',$id)->get()->first()) !== null ){
        $amountRating = Rating::select('score')->where('sales_user_id',$id)->get()->first()->score;
        return view('dummyReward',compact('amountRating'));
        //return compact('amountRating');
    }else{
      $amountRating = 0;
      return view('dummyReward',compact('amountRating'));
    }

  }




  public function compareProduct(){
    $rewardedProduct = "reksadana ";
  }
}
