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
        $horainicio=0;
        $horafin=0;
        $horastotales=0;
        
         $horainicio=$datosEvento["horaInicioInt"];
            $horafin=$datosEvento["horaFinInt"];
            $horastotales=$horafin-$horainicio;
            
            if ($datosEvento["ilimitado"] == 0) {
                if ($horastotales>4) {
                $bandera=4;
            }
            }

            if ($datosEvento["horaInicioInt"] >= $datosEvento["horaFinInt"]) {
                $bandera=1;
            }

            
            
           
        foreach ($eventos as $evento) {
            
           
            if ($datosEvento["ilimitado"] == 1) {
                echo "Se cambia por ilimitado";
                $bandera=6;
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
        }
   

         if ($bandera==0) {
            evento::insert($datosEvento);
            return response()->json([$datosEvento,'bandera'=>0]);
         }

         if ($bandera==0) {
            return response()->json(['bandera'=>0]);
                  }

         if ($bandera==4) {
            return response()->json(['bandera'=>4]);
         }
        
         if ($bandera==6) {
            return response()->json(['bandera'=>6]);
         }

         if ($bandera==1) {
            return response()->json(['bandera'=>1]);
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
                $bandera=2;
                $horainicio=0;
                $horafin=0;
                $horastotales=0;
                
                $horainicio=$datosEvento["horaInicioInt"];
                $horafin=$datosEvento["horaFinInt"];
                $horastotales=$horafin-$horainicio;

                if ($datosEvento["ilimitado"] == 0) {
                    if ($horastotales>4) {
                    $bandera=4;
                }
                }
                if ($datosEvento["horaInicioInt"] >= $datosEvento["horaFinInt"]) {
                 $bandera=1;
                 }

                $eventos=evento::where("diaInicio",$datosEvento["diaInicio"])->where("idLugar",$datosEvento["idLugar"])->get();

                
               
    
               
                foreach ($eventos as $evento) {

                    
                    echo "--";
                    echo $datosEvento["horaInicioInt"];
                    echo "--";
                    echo $evento["horaInicioInt"];
                    echo "--";
                    
                    if ($datosEvento["ilimitado"] == 1) {
                    echo "Se cambia por ilimitado";
                    $bandera=6;
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


                if ($bandera==2) {
                $respuesta=evento::where('id','=',$id)->update($datosEvento);
                return response()->json([$respuesta,'badera'=>2]);
                 
                }
                 if ($bandera==4) {
                    return response()->json(['bandera'=>4]);
                 }
                
                 if ($bandera==6) {
                    return response()->json(['bandera'=>6]);
                 }
        
                 if ($bandera==1) {
                    return response()->json(['bandera'=>1]);
                 }
                 
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
        return response()->json([$id,'bandera'=>3]);
    }
}
