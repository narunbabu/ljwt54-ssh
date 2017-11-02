<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\District;

class SthaliController extends Controller
{

   public function index()
   {
       return District::all();
   }

   public function show( $dist_code)
   {
    //return $request;//  "hello this";
    //  return District::find($dist_code);
     $sub_dist=DB::select('select `sub_dist_code`, `sub_dist_name` from `subdistricts` where `subdistricts`.`dist_code` ='.$dist_code);
     return $sub_dist;
   }

   public function show_vils( $sub_dist_code)
   {
    //return $request;//  "hello this";
    //  return District::find($dist_code);
     $vils=DB::select('select `vil_code`, `vil_name` from `villages` where `villages`.`sub_dist_code` ='.$sub_dist_code);
     return $vils;
   }
   public function show_village( $vil_code)
   {
    //return $request;//  "hello this";
    //  return District::find($dist_code);
     $vils=DB::select('select * from `villages` where `villages`.`vil_code` ='.$vil_code);
     return $vils;
   }

}
