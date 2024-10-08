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
        //tmp_name pega a extensão e o diretório do arquivo
        $csvData = array_map('str_getcsv', file($_FILES['file']['tmp_name']));
        $cabecalho = array_shift($csvData);

        $pimaco = new Pimaco($_POST['etiqueta']); //pega o value do option
        $alinhamento = $_POST['alignment'];
        
        foreach($csvData as $i){
            $tag = new Tag();
            $tag->p(view('pdfs.etiquetas',['conteudo' => $i, 'alinhamento' => $alinhamento]));
            $pimaco->addTag($tag);
        }
        $pimaco->output();
    }

    public function download(){
        $arquivo = public_path('modelo.csv');
        return response()->download($arquivo);
        return redirect('/');
    }
} 
