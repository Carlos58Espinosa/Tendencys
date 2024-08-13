<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CatalogProduct;
use Illuminate\Support\Facades\DB;
use Validator;

class CatalogProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CatalogProduct::all();
    }

    /**
     * Store a newly created resource in storage.
     *
        Parámetros:
            name:  Cadena,
            description: Cadena Opcional,
            height: Entero,
            length: Entero,
            width: Entero
     */
    public function store(Request $request)
    {
        $customMessages = [
            'name.required' => 'El campo name es requerido.',
            'name.string' => 'El campo name debe ser cadena.',
            'description.string' => 'El campo description debe ser cadena.',
            'height.integer' => 'El campo height debe ser entero.',
            'length.integer' => 'El campo length debe ser entero.',
            'width.integer' => 'El campo width debe ser entero.',
        ];
        $this->validate($request, [
            'name' => 'required|string', 
            'description' => 'string|nullable',                    
            'height' => 'integer',
            'length' => 'integer',
            'width' => 'integer',
        ] 
        ,$customMessages);

        $transaction = DB::transaction(function() use($request){
            return CatalogProduct::create($request->all());
        });
        return $transaction;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return CatalogProduct::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
        Parámetros Request:
            name:  Cadena,
            description: Cadena Opcional,
            height: Entero,
            length: Entero,
            width: Entero

     */
    public function update(Request $request, $id)
    {
        $customMessages = [
            'name.required' => 'El campo name es requerido.',
            'name.string' => 'El campo name debe ser cadena.',
            'description.string' => 'El campo description debe ser cadena.',
            'height.integer' => 'El campo height debe ser entero.',
            'length.integer' => 'El campo length debe ser entero.',
            'width.integer' => 'El campo width debe ser entero.',
        ];
        $this->validate($request, [
            'name' => 'required|string', 
            'description' => 'string|nullable',                    
            'height' => 'integer',
            'length' => 'integer',
            'width' => 'integer',
        ] 
        ,$customMessages);
        $transaction = DB::transaction(function() use($request, $id){
            $product = CatalogProduct::findOrFail($id);
            $product->update($request->all());
            $product->save();
            return $product;
        });
        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CatalogProduct::destroy($id);
    }
}
