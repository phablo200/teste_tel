<?php
/**
 * Created by PhpStorm.
 * User: phablo sena
 * Date: 14/11/2017
 * Time: 13:09
 */

namespace App;
use DB;

trait Helper
{
    public function dataSql(string $data) : string
    {
        if (!empty($data) and !is_numeric($data)) {
            if (strlen($data) === 10) {
                $partes = explode('/', $data);
                $dt     = $partes[2] . '-' . $partes[1] . '-' . $partes[0];

                return $dt;
            }
            return null;
        }
        return null;
    } // Fim dataSql()


    public function dataBr(string $data) :string
    {
        return date("d/m/Y", strtotime($data));
    }

    public function dataBrComHora(string $data) :string
    {
        return date("d/m/Y H:i", strtotime($data));
    }

    public function incrementarDataBr(string $data, int $numeroDias) {
        return date("d/m/Y", strtotime("+" . $numeroDias . " days", strtotime($data)));
    }

    public function incrementarDataBrComHora(string $data, int $numeroDias) {
        return date("d/m/Y H:i", strtotime("+" . $numeroDias . " days", strtotime($data)));
    }

    public function incrementarDataSql(string $data, int $numeroDias) {
        return date("Y-m-d", strtotime("+" . $numeroDias . " days", strtotime($data)));
    }

    public function incrementarDataSqlComHora(string $data, int $numeroDias) {
        return date("Y-m-d H:i:s", strtotime("+" . $numeroDias . " days", strtotime($data)));
    }

    public function dataSqlComHora (string $data) : string
    {
        if (!empty($data)) {
            $campos = explode(" ", $data);
            $data = $this->dataSql($campos[0]);
            $hora = $campos[1];
            return $data . " " . $hora;
        }

        return null;
    }

    public function diaSemanaBr(string $data) : string
    {
        $dia = date('D', strtotime($data));
        switch ($dia) {
            case "Sun":
                return "DOMINGO";
                break;
            case "Mon" :
                return "SEGUNDA FEIRA";
                break;
            case "Tue":
                return "TERÇA FEIRA";
                break;
            case "Wed":
                return "QUARTA FEIRA";
                break;
            case "Thu":
                return "QUINTA FEIRA";
                break;
            case "Fri":
                return "SEXTA FEIRA";
                break;
            case "Sat":
                return "SÁBADO";
                break;
        }
    }

    public function dataExtenso($data)
    {
        $ano = date('Y', strtotime($data));
        $dia = date('d', strtotime($data)) - 0;
        $dsemana = date('w', strtotime($data));
        $data = date('n');
        $mes[1] = 'Janeiro';
        $mes[2] = 'Fevereiro';
        $mes[3] = 'Março';
        $mes[4] = 'Abril';
        $mes[5] = 'Maio';
        $mes[6] = 'Junho';
        $mes[7] = 'Julho';
        $mes[8] = 'Agosto';
        $mes[9] = 'Setembro';
        $mes[10] = 'Outubro';
        $mes[11] = 'Novembro';
        $mes[12] = 'Dezembro';
        $semana[0] = 'Domingo';
        $semana[1] = 'Segunda-Feira';
        $semana[2] = 'Terça-Feira';
        $semana[3] = 'Quarta-Feira';
        $semana[4] = 'Quinta-Feira';
        $semana[5] = 'Sexta-Feira';
        $semana[6] = 'Sádado';
        return $dia . ' de ' . $mes[$data] . ' de ' . $ano;
    }


    public function getFormatarValores($valor)
    {
        $valorRsRemovido      = str_replace("R$", "", $valor);
        $valorEspacoRemovido  = trim($valorRsRemovido);
        $valorFormatado       = str_replace(',', '.', str_replace('.', '', $valorEspacoRemovido));
        return $valorFormatado;
    }

    public function eFeriado($data)
    {
        $feriado = DB::table("feriado")->select("fer_descricao", "fer_data_feriado")
                ->where("fer_data_feriado", "=", $data)
                ->first();

        if (!is_nulL($feriado)) {
            return true;
        } 

        return false;
    }

    public function eFimDeSemana($data)
    {
        if (date('N', strtotime($data)) > 5) {
            return true;
        }

        return false;
    }

    public function getMoedaPadraoBrasil($valor)
    {
        return number_format($valor, 2, ',', '.');
    }

    public function getMoedaPadraoBrasilCifrao($valor)
    {
        return "R$ " . number_format($valor, 2, ',', '.');
    }
	
	public function tratarCpf (string $cpf)
	{
		$documento = str_replace(".", "", $cpf);
		$documento = str_replace("-", "", $documento);
		return $documento;
	}
	
	public function tratarCnpj (string $cnpj)
	{
		$documento = str_replace(".", "", $cnpj);
		$documento = str_replace("-", "", $documento);
		$documento = str_replace("/", "", $documento);
		return $documento;
	}
	
	public function tratarCep(string $cep)
	{
		return str_replace("-", "", $cep);
	}
	
	public function replaceStringEspecial(string $string) {
        // matriz de entrada
        $what = array('º', 'ª', 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À', 'Ã', 'Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );

        // matriz de saída
        $by   = array(' ', ' ', 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A', 'A', 'A','E','I','O','U','n','n','c','C',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ' );
        // devolver a string
        return str_replace($what, $by, $string);
    }

	public function validarCPF($cpf) { 
		// Extrai somente os números
		$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
		 
		// Verifica se foi informado todos os digitos corretamente
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}
		// Faz o calculo para validar o CPF
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}
		return true;
	}

	public function validarCNPJ($cnpj)
	{
		$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
		// Valida tamanho
		if (strlen($cnpj) != 14)
			return false;
		// Valida primeiro dígito verificador
		for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
		{
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;
		if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
			return false;
		// Valida segundo dígito verificador
		for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
		{
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;
		return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
	}
}