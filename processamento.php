<?php
include 'classes.php';

// CONFIGS DA TELA
    $TELA_LARGURA = 600;
    $TELA_ALTURA = 600;
    $X_INICIO = 0;
    $Y_INICIO = 0;

// TRANSFORMA JSON EM LISTA DE OBJETOS
    $json_data = file_get_contents('medalhas.json');
    $paises_data = json_decode($json_data, true);
    $paises = [];
    foreach ($paises_data as $pais_data) {
        $pais = new Pais($pais_data['nome'], $pais_data['medalhas_2020'], $pais_data['medalhas_2016']);
        $paises[] = $pais;
    }

// ORDENA PAISES POR MEDALHA EM 2020
    function ordenarPorMedalhas2020($a, $b) {
        return $b->medalhas_2020 - $a->medalhas_2020;
    }
    usort($paises, 'ordenarPorMedalhas2020');

// SOMA TOTAL MEDALHAS_2020
    $totalMedalhas2020 = array_reduce($paises, function($total, $pais) {
        return $total + $pais->medalhas_2020;
    }, 0);

// CALCULA PERCENTUAL RELATIVO
    $medalhasRestantes = $totalMedalhas2020;
    foreach ($paises as $pais) {
        $pais->relativo = $pais->medalhas_2020 / $medalhasRestantes;
        $medalhasRestantes -= $pais->medalhas_2020;
    }

// CALCULA TAMANHO E LOCALIZACAO
    $LARGURA_DISPONIVEL = $TELA_LARGURA;
    $ALTURA_DISPONIVEL =  $TELA_ALTURA;
    $X_DISPONIVEL = $X_INICIO;
    $Y_DISPONIVEL = $X_INICIO;

    foreach ($paises as $pais) {
        $pais->eixo_x = $X_DISPONIVEL;
        $pais->eixo_y = $Y_DISPONIVEL; 

        if($pais->relativo == 1){  //VERIFICA SE É O ULTIMO PAIS
            $pais->altura = $TELA_ALTURA - $Y_DISPONIVEL;
            $pais->largura = $TELA_LARGURA - $X_DISPONIVEL;
        } else{
        
            if($ALTURA_DISPONIVEL >= $LARGURA_DISPONIVEL){ //CRIA ELEMENTO MAIS LARGOS
                $pais->largura = $LARGURA_DISPONIVEL;
                $pais->altura = $pais->relativo * $ALTURA_DISPONIVEL;
                $ALTURA_DISPONIVEL = $ALTURA_DISPONIVEL - $pais->altura;
                $Y_DISPONIVEL = $Y_DISPONIVEL + $pais->altura;
            } else{ //CRIA ELEMENTOS MAIS ALTOS
                $pais->altura  = $ALTURA_DISPONIVEL;
                $pais->largura = $pais->relativo * $LARGURA_DISPONIVEL;
                $LARGURA_DISPONIVEL = $LARGURA_DISPONIVEL - $pais->largura;
                $X_DISPONIVEL = $X_DISPONIVEL + $pais->largura;
            }
        }
    }

// DEBUG
    /*        echo "Total de Medalhas 2020: " . $totalMedalhas2020 . "<br><br>";

            foreach ($paises as $pais) {
            $pais->exibirDetalhes();
            }
    */  
?>
