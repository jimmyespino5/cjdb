<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\TypeService;
use Illuminate\Support\Str;
use App\Http\Requests\ServiceFormRequest;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Muestra lista de recursos a los usuarios no logueados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('service.index', compact("services"));
    }

     /**
     * Muestra lista de recursos a los usuarios logueados
     *
     * @return \Illuminate\Http\Response
     */
    public function list() 
    {
        //$posts = Post::all();
        $services = Service::paginate(2);
        return view('service.list', compact("services"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeServices = TypeService::all();
        return view('service.create', compact("typeServices"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceFormRequest $request)
    {
        $service=new Service(); 
        //dd($request);
        $service->name=$request->input('name');
        $service->description=$request->input('description');
        $service->price=$request->input('price');
        $service->location=$request->input('location');
        $service->teacher=$request->input('teacher');
        
        $typeServices = TypeService::where('name','=',$request->input('type'))->get('id');
        foreach ($typeServices as $type) {
            $idTypeService = $type->id;
        }
        $service->typeservices_id=$idTypeService;

        $file = $request->file('image'); //obtenemos el campo file definido en el formulario
        $nombre = "images/servicios/".$file->getClientOriginalName();//obtenemos el nombre del archivo
        $nombre_file = "servicios/".$file->getClientOriginalName();

        $service->image=$nombre;

        \Storage::disk('local')->put($nombre_file,  \File::get($file));//indicamos que queremos guardar un nuevo archivo en el disco local

        $service->save();
        return redirect()->route('service.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $typeServices = TypeService::all();
        return view('service.edit', compact('service', 'typeServices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceFormRequest $request, Service $service)
    {
        $service->name=$request->input('name');
        $service->description=$request->input('description');
        $service->price=$request->input('price');
        $service->location=$request->input('location');
        $service->teacher=$request->input('teacher');

        $file = $request->file('image'); //obtenemos el campo file definido en el formulario
        if($file != null){ //si cambiaron la imagen, elimino la anterior y la guardo

            $delete = Str::of($service->image)->substr(6);
            \Storage::disk('local')->delete($delete);

            $nombre = "images/servicios/".$file->getClientOriginalName();//obtenemos el nombre del archivo
            $service->image=$nombre;
            $nombre_file = "servicios/".$file->getClientOriginalName();
            \Storage::disk('local')->put($nombre_file,  \File::get($file));
        }

        $service->save();
        return redirect()->route('service.edit',[$service])
                         ->with('message','Servicio Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $delete = Str::of($service->image)->substr(6);
        \Storage::disk('local')->delete($delete);

        $service->delete();
        return redirect()->route('service.list');
    }
}
