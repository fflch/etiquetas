<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use App\Models\Etiqueta;

class EtiquetaController extends Controller
{
    public function etiquetas(){
       
        $etiquetas = Etiqueta::skip(8000)->take(2000)->get();
        $pimaco = new Pimaco('A4356'); # 
        #$pimaco = new Pimaco('A4256'); # 


        foreach($etiquetas as $etiqueta){
            $tag = new Tag();
            #$tag->setBorder(0);
            #$tag->setSize(1);
            
            $tag->p(
                view('pdfs.etiquetas',[
                    'conteudo' => $etiqueta->conteudo
                ])
            );
            $pimaco->addTag($tag);
        }

        $pimaco->output();

    }

    public function fixed(){

        $pimaco = new Pimaco('A4356'); # 

        $conteudo = '<br><b>FFLCH-USP</b><br>
                     Rua do Lago, 717 - Diretoria <br>
                     Cidade Universitária <br> 
                     05508-080 São Paulo - SP';

        foreach(range(1, 33) as $i){
            $tag = new Tag();            
            $tag->p(
                view('pdfs.etiquetas',[
                    'conteudo' => $conteudo
                ])
            );
            $pimaco->addTag($tag);
        }

        $pimaco->output();

    }
} 
