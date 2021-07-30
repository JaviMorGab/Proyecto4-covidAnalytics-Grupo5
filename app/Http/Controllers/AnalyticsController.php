<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Country;
use App\Models\Region;
use App\Models\Entry;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function getCountries() {
        $countries = Country::with('entries');
        return['countries' => $countries];
     }

     public function getRegions() {
        $regions = Region::all();
        return['regions' => $regions];
     }

     public function getEntries() {
        $entries = Entry::with('country')->paginate(6);
        return['entries' => $entries];
     }

     
  // Paises por fecha//

public function consultaPaisDia($fecha)
    {
        $formatofecha = str_replace("-", "/", $fecha);
        $pais_dia = Entry::with('country') -> where('dateRep' , '=', $formatofecha)->get();
        return ['pais_dia' => $pais_dia];
    }

  // un pais en concreto buscando por dia//
       
public function consultaPaisConcreto($fecha, $countries)
   {
      $formatofecha = str_replace("-", "/", $fecha);
      $ciudades = Country::where('countriesAndTerritories', "=", $countries)->get();
      $pais_concreto = Entry::with('country')-> where('country_id', '=', $ciudades[0]->id) ->where('dateRep', '=', $formatofecha)->get();
      return ['pais_concreto' => $pais_concreto];
   }

   public function consultasuma()
   {
     $suma = DB::table('entries')
    ->Join('countries','countries.id','=','entries.country_id')
    ->select('entries.country_id','countries.countriesAndTerritories',DB::raw('SUM(entries.cases) AS cases'),DB::raw('SUM(entries.deaths) AS deaths'))
    ->groupBy('entries.country_id')
    ->get();
    return ['suma' => $suma];
   }

   public function consultaelpais($countriesAndTerritories)
   {
   $suma1 = DB::table('entries')
    ->Join('countries','countries.id','=','entries.country_id')
    ->select('entries.country_id','countries.countriesAndTerritories',DB::raw('SUM(entries.cases) AS cases'),DB::raw('SUM(entries.deaths) AS deaths'))
    ->groupBy('entries.country_id')
    ->where ('countriesAndTerritories', '=', $countriesAndTerritories)
    ->get();
    return ['suma' =>$suma1];
   }
}

