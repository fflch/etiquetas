<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use App\Models\Etiqueta;
use App\Http\Requests\EtiquetaRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class EtiquetaController extends Controller
{
    public function index(Etiqueta $etiquetas){
        return view('index')->with(['etiquetas' => $etiquetas]);
    }

    public function geraEtiqueta(EtiquetaRequest $request){
        $this->authorize('is_user');
        $csvData = array_map('str_getcsv', file($request->file('file')->getPathName()));
        if($request->cabecalho){
            array_shift($csvData);
        }
        $pimaco = new Pimaco($request->etiqueta);
        foreach($csvData as $data){
            $tag = new Tag();
            $tag->p(view('pdfs.etiquetas',[
                'conteudo' => $data,
                'alinhamento' => $request->alignment,
                'mesq' => $request->mesq,
                'mdir' => $request->mdir,
                'msup' => $request->msup,
                'minf' => $request->minf
            ]));
            $pimaco->addTag($tag);
        }
        $pimaco->output();
    }

    public function download(){
        $arquivo = public_path('modelo.csv');
        return response()->download($arquivo);
    }
}
