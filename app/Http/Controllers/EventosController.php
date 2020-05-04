<?php

namespace App\Http\Controllers;
use App\evento;
use App\sede;
use Illuminate\Http\Request;


class EventosController extends Controller
{  
    public function show()
    {
        $data['eventos']=evento::all();
        return  response()->json($data['eventos']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['eventos']=evento::all();
        // return  response()->json($data['eventos']);

        $sedes = sede::where("eliminado",0)->get();
        return view("eventos/index")->with(compact('sedes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosEvento=request()->except(['_token','_method']);

        $eventos=evento::where("diaInicio",$datosEvento["diaInicio"])->where("idLugar",$datosEvento["idLugar"])->get();

        $bandera=0;
        
        foreach ($eventos as $evento) {
            
            if ($datosEvento["ilimitado"] == 1) {
                echo "Se cambia por ilimitado";
                $bandera=1;
                }
            
            if ($datosEvento["horaInicioInt"] >= $evento["horaInicioInt"]) {
                if ($datosEvento["horaInicioInt"] <= $evento["horaFinInt"] ) {
                    echo "se cambia la bandera";
                    $bandera=1;
                }
            }

            if($datosEvento["horaFinInt"]>=$evento["horaInicioInt"] ){
                if ($datosEvento["horaFinInt"]<=$evento["horaFinInt"] ) {
                    echo "se cambia la bandera";
                    $bandera=1;
              }
            }

            if($datosEvento["horaInicioInt"]>=$evento["horaInicioInt"] ){
                if ($datosEvento["horaFinInt"]<=$evento["horaFinInt"] ) {
                    echo "se cambia la bandera";
                    $bandera=1;
              }
            }

            if($datosEvento["horaInicioInt"]<=$evento["horaInicioInt"] ){
                if ($datosEvento["horaFinInt"]>=$evento["horaFinInt"] ) {
                    echo "se cambia la bandera";
                    $bandera=1;
              }
            }

            // echo"por cada evento as eventos";
            // echo $evento;
            // echo "HOLAHOLAHOLAHOLA";

        }
        // @foreach ($evento as $eventos)

        // <p>id del evento que cumple las condicioens {{ $evento->id }}</p>

        // @endforeach
        
        // echo"hola estamos en el lugar que tu quieres";
        // echo "Para escapar caracteres se hace \"así\".";
        // echo $eventos;







    //    $idLugar=$datosEvento["color"];
    // && ambas   
    // || este o este
    //     echo $idLugar;
        // print_r("se puede escribir?");
        
        // echo $idLugar;
        //  
        // //  
        //  exit();
         if ($bandera==0) {
            evento::insert($datosEvento);
            return [$datosEvento];
         }
         
        // evento::insert($datosEvento);
        // return [$datosEvento];
    }

    public function valid()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $datosEvento=request()->except(['_token','_method']);
        


                $eventos=evento::where("diaInicio",$datosEvento["diaInicio"])->where("idLugar",$datosEvento["idLugar"])->get();

                
                $bandera=0;
                foreach ($eventos as $evento) {

                    
                    echo "--";
                    echo $datosEvento["horaInicioInt"];
                    echo "--";
                    echo $evento["horaInicioInt"];
                    echo "--";
                    
                    if ($datosEvento["ilimitado"] == 1) {
                    echo "Se cambia por ilimitado";
                    $bandera=1;
                    }
                    
                    if ($datosEvento["horaInicioInt"] >= $evento["horaInicioInt"]) {
                        if ($datosEvento["horaInicioInt"] < $evento["horaFinInt"] ) {
                            echo "se cambia la bandera 1";
                            $bandera=1;
                        }
                    }
                    if ($datosEvento["horaInicioInt"]==$evento["horaInicioInt"]) {
                        if ($datosEvento["horaFinInt"]==$evento["horaFinInt"]) {
                            echo "se cambia la bandera 2";
                            $bandera=1;
                        }
                    }
                    

                    if($datosEvento["horaFinInt"]>$evento["horaInicioInt"] ){
                        if ($datosEvento["horaFinInt"]<$evento["horaFinInt"] ) {
                            echo "se cambia la bandera 3";
                            $bandera=1;
                    }
                    }

                    if($datosEvento["horaInicioInt"]>$evento["horaInicioInt"] ){
                        if ($datosEvento["horaFinInt"]<$evento["horaFinInt"] ) {
                            echo "se cambia la bandera 4";
                            $bandera=1;
                    }
                    }

                    if($datosEvento["horaInicioInt"]<$evento["horaInicioInt"] ){
                     
                        if ($datosEvento["horaFinInt"]>$evento["horaFinInt"] ) {
                            
                            echo "se cambia la bandera 5";
                            // echo  $datosEvento["horaFinInt"];
                            // // echo $evento["horaFinInt"];

                            $bandera=1;
                    }
                    }

                    

                    // echo"por cada evento as eventos";
                    // echo $evento;
                    // echo "HOLAHOLAHOLAHOLA";

                }


                if ($bandera==0) {
                $respuesta=evento::where('id','=',$id)->update($datosEvento);
        return response()->json($respuesta);
                 }
        // $respuesta=evento::where('id','=',$id)->update($datosEvento);
        // return response()->json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventos=evento::findOrFail($id);
        evento::destroy($id);
        return response()->json($id);
    }
}
