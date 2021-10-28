<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;

class ReplicadoUtils {

    /* Este método retorna o endereço... */
    /* Ele é transitório, pois foi enviaod um issue... */
    /* https://github.com/uspdev/replicado/issues/226  */
    public static function endereco($codpes) {
        $data = DBreplicado::fetch('SELECT codpes, nompes from PESSOA where codpes=5385361');
        return $data['codpes'] . " - " . $data['nompes'];
    }

    /**
     * Retorna o endereço completo, com rua/avenida etc., número/complemento, 
     * bairro, cidade e UF a partir do codpes.
     * Método transitório, pois ainda não foi criado issue...
     * @param type $codpes
     * @return String
     */
    public static function enderecoCompleto($codpes){
        $query = "SELECT p.codpes, tl.nomtiplgr, p.epflgr, p.numlgr, p.cpllgr, p.nombro, l.cidloc, l.sglest, p.codendptl 
                    FROM ENDPESSOA p 
                    JOIN LOCALIDADE l
                    ON p.codloc = l.codloc 
                    JOIN TIPOLOGRADOURO tl
                    ON p.codtiplgr = tl.codtiplgr 
                    WHERE codpes = convert(int,:codpes)";
        $param = [
            'codpes' => $codpes,
        ];
        $result = DBreplicado::fetch($query, $param);
        if (!empty($result)) {
            $result = Uteis::utf8_converter($result);

            $aux = str_split($result['codendptl']);
            if(count($aux) == 8)
                $cep = $aux[0].$aux[1].$aux[2].$aux[3].$aux[4].'-'.$aux[5].$aux[6].$aux[7];
            else $cep = '';

            $address = $result['nomtiplgr'] . ": " . $result['epflgr'] . ", " . $result['numlgr'];

            if( !empty($result['cpllgr']) && $result['cpllgr'] != 'null') $address .= "<br>" .$result['cpllgr'];
            
            $address .="<br>" . $result['nombro'];
            $address .="<br>" . $cep . ' ' . $result['cidloc'] . " - " . $result['sglest']; 
            return $address;
        }
        return false;
    }

}