<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Uspdev\Replicado\Graduacao;
use App\Models\Etiqueta;
use App\Utils\ReplicadoUtils;

class EtiquetaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'etiquetas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Etiqueta';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Limpa tabela das etiquetas
        Etiqueta::truncate();

        $alunos = Graduacao::ativos(8);

        foreach($alunos as $aluno){
            
            $address = ReplicadoUtils::enderecoCompleto($aluno['codpes']);
            if(!empty($address)){
                $etiqueta = new Etiqueta;
                $etiqueta->controle = $aluno['codpes'];
    
                $etiqueta->conteudo = '<b>' . $aluno['nompes'] . '</b>' . '<br>';
                $etiqueta->conteudo .= $address;
                
                $etiqueta->save();
            }

        }
        return Command::SUCCESS;
    }
}
