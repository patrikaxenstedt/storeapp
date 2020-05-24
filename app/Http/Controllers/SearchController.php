<?php

/* Denna controller skapades med hjälp utav "php artisan make:controller NamnPåController */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /* Funktion som plockar fram "shipOrigins" som tex Starwars, Startrek och visar dessa
      i "result.blade.php" om sökorden matchar dessa. */
      public function index(Request $request) {

        $search = $request->input('search');
        $ships = \DB::table('ships')->where('shipOrigin', 'LIKE', '%' . $search)->get(); 
    
        return view('result', ['ships' => $ships]);
    }
    

    /* Funktion som plockar ut all data från table "Ships" och
       retunerar dessa till vyn "listall.blade.php".*/
    public function listAll() {
        $ships = \DB::table('ships')->get();

        return view('listall', ['ships' => $ships]);
    }

    /*  */
    public function getResult(Request $request) {

        $results = $request->input('getshipid');
      
    
        $sum = 0;
       
       
        $resultArray['ships'] = \DB::table('ships')->whereIn('id', $results)->get();
     

        foreach ($resultArray['ships'] as $ship) {
            $sum = $sum + (int)$ship->shipPrice;
        }
        
        
        return view('buy', $resultArray, ['sum' => $sum]);
        
    }
    /* Funktion som nollställer "$mapArray + $sum" */ 
    public function clear() {
        unset($mapArray);
        unset($sum);

        return view('clear');
    }
    
}
    

