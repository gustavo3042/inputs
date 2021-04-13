<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicField;
use Validator;

class DynamicFieldController extends Controller
{


  function index()
   {

$mostrar= DynamicField::where('id','=',1)->find(10);
    return view('dynamic_field',compact('mostrar'));

//,compact('mostrar')

   }





   function insert(Request $request){


    if($request->ajax())
    {

     $rules = array(
      'first_name.*'  => 'required',
      'last_name.*'  => 'required',
      'sueldo.*'  => 'required'
     );


     $error = Validator::make($request->all(), $rules);

     if($error->fails())
     {
      return response()->json([
       'error'  => $error->errors()->all()
      ]);
     }

     $first_name = $request->first_name;
     $last_name = $request->last_name;
     $sueldo = $request->sueldo;

     for($count = 0; $count < count($first_name); $count++)
     {
      $data = array(
       'first_name' => $first_name[$count],
       'last_name'  => $last_name[$count],
       'sueldo' => $sueldo[$count]
      );
      $insert_data[] = $data;
     }

     DynamicField::insert($insert_data);

     return response()->json([
      'success'  => 'Data Added successfully.'
     ]);
    }
   }


}
