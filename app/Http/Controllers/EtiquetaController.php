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

        $csvData = array_map('str_getcsv', file($_FILES["file"]["tmp_name"]));
        $cabecalho = array_shift($csvData);
        $nome = array_search("Nome", $cabecalho); //pula a primeira linha do csv
        $mime = mime_content_type($_FILES['file']['tmp_name']);

        if($mime == "text/csv" || $mime == "text/plain" && $csvData){
            $pimaco = new Pimaco($_POST['etiqueta']);
            
            $alinhamento = $_POST['alignment'];
            $mesq = $_POST['mesq'];
            $mdir = $_POST['mdir'];
            $msup = $_POST['msup'];
            $minf = $_POST['minf'];

            foreach($csvData as $i){
                $tag = new Tag();
                $tag->p(view('pdfs.etiquetas',[
                'conteudo' => $i,
                'alinhamento' => $alinhamento, 
                'mesq' => $mesq,
                'mdir' => $mdir,
                'msup' => $msup,
                'minf' => $minf
            ]));
                $pimaco->addTag($tag);
            }
            $pimaco->output();
        }else{
            request()->session()->flash('alert-danger',"Insira um arquivo CSV válido.");
            return redirect('/');
        }
    }

    public function download(){
        $arquivo = public_path('modelo.csv');
        return response()->download($arquivo);
        return redirect('/');
    }
} 
