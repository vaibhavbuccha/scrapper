<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;

class country extends Controller
{
    public function index()
    {
        $universities = University::orderBy('id', 'DESC')->get();
        return response()->json($universities);
    }

    public function store(Request $request){
        foreach($request->all() as $value){
            $universityFind = University::where('name',$value['name'])->where('country',$value['country'])->get()->count();
            if($universityFind == 0){
                // print_r('if');
                $university = new University();
                $state = 'state-province';
                $university->name = $value['name'];
                $university->$state = $value['state-province'] ?? 'Not Applicable';
                $university->alpha_two_code = $value['alpha_two_code'];
                $university->country = $value['country'];
                $university->web_pages = $value['web_pages'][0];
                $university->domains = $value['domains'][0];
                $university->save();
            }
            // return ['message'=> 'success'];
        }
    }

}
