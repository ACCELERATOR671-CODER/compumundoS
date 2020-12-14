<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\imagen;
use Illuminate\Support\Facades\DB;
use App\Models\ViewProduct;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;

class ProductoController extends Controller
{
    public function getItemProd($id)
    {
        $item = Producto::findOrFail($id);
        return response()->json($item->load('uploadImagen'), 201);
    }

    public function getProductsView()
    {
        $data = ViewProduct::all();

        return response()->json($data, 200);
    }

    public function insertProduct(Request $request)
    {
        $producto = new Producto();
        $producto->nom_prod = $request->nom;
        $producto->desc_prod = $request->desc;
        $producto->carac_prod = $request->carac;
        $producto->tipo_prod = $request->tipo;
        $producto->precio_prod = $request->precio;
        $producto->cant_prod = (isset($request->cant)) ? $request->cant:0;
        /*postgresql*/$producto->fecha_prod = date('Y-m-d H:i:s');
        $producto->save();

        $nombre = null;
        if(isset($request->img))
        {
            $img = $request->file('img');
            $nombre = time()."_".$img->getClientOriginalName();
            $img->move('images2', $nombre);
        }


        $id = Producto::orderby('id_prod', 'desc')->first();
        $imagen = new imagen();
        $imagen->img = $nombre;
        $imagen->fk_prod = $id->id_prod;
        $imagen->save();

        return redirect('/', 201);
    }

    public function getProductView($id)
    {
        return view('producto', ['id_prod' => $id]);
    }

    public function getProductRegistryView()
    {
        if(session()->has('id'))
        {
            if(session('type_user') == '1')
            {
                return view('registro_producto');
            }
        }
        return redirect(route('inicio'));
    }

    public function verifyProductExists($nombre)
    {
        $columna = DB::table('producto')->where('nom_prod', '=', $nombre)->count();

        $estado = ($columna>0) ? true:false;

        return response()->json(['estado' => $estado],200);
    }
}
