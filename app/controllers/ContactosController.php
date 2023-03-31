<?php

namespace App\Controllers;

use App\Models\Contactos;

class ContactosController extends Controller
{
  public function index()
  {
    $datos = Contactos::all();
    response()->json($datos);
  }
  public function consultar($id)
  {
    $datos = Contactos::find($id);
    response()->json($datos);
  }
  public function agregar()
  {
    $datos = new Contactos;
    $datos->name = app()->request()->get('name');
    $datos->first_name = app()->request()->get('first_name');
    $datos->second_name = app()->request()->get('second_name');
    $datos->email = app()->request()->get('email');

    $datos->save();
    response()->json(["message" => "Success"]);
  }

  public function eliminar($id)
  {
    Contactos::destroy($id);
    response()->json(["message" => "el registro se ha eliminado"]);
  }

  public function actualizar($id)
  {

    $name = app()->request()->get('name');
    $first_name = app()->request()->get('first_name');
    $second_name = app()->request()->get('second_name');
    $email = app()->request()->get('email');


    $contacto = Contactos::findOrFail($id);

    $contacto->name = ($name != '') ? $name : $contacto->name;
    $contacto->first_name = ($first_name != '') ? $first_name : $contacto->first_name;
    $contacto->second_name = ($second_name != '') ? $second_name : $contacto->second_name;
    $contacto->email = ($email != '') ? $email : $contacto->email;

    $contacto->update();

    response()->json(["message" => "el registro se ha actualizado"]);

  }
}