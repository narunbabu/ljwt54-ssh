<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\District;
use App\State;

class SthaliController extends Controller
{
  public function indexst()
  {   
    // $states = DB::table('states')->get();
    return State::all();  

  }  

   public function showst( $state_code)
   {
    return $state=State::where('state_code', $state_code)->firstOrFail();
   }

   public function showd($state_code)
   {
      //  return District::all();
      //  return $districts = District::where('state_code', $state_code)->findOrFail();
       return $districts = DB::table('districts')->where('state_code','=', $state_code)->get(); 
   }

   public function showsds( $dist_code)
   {
    return $subdistricts = DB::table('subdistricts')->where('dist_code','=', $dist_code)->get();    
   }

   public function show_vils( $sub_dist_code)
   {
    // return $vils = DB::table('village_details')->where('sub_dist_code','=', $sub_dist_code)->get();  
     $vils=DB::select('select `vil_code`, `vil_name` from `village_details` where `village_details`.`sub_dist_code` ='.$sub_dist_code);
     return $vils;
   }
   public function show_village( $vil_code)
   {
    //return $request;//  "hello this";
    //  return District::find($dist_code);
     $vil=DB::select('select `vil_name`,`pin_code`,`tot_geograph_area`,`tot_households` from `village_details` where `village_details`.`vil_code` ='.$vil_code.' limit 1');
     return $vil;
   }

}
