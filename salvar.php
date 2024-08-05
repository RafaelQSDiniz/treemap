<?php
// Recebe os dados enviados
$data = file_get_contents('php://input');

// Decodifica o JSON recebido
$dados = json_decode($data, true);

if (json_last_error() === JSON_ERROR_NONE) {
    // Lê o arquivo JSON atual
    $arquivo = 'medalhas.json';
    $json_data = file_get_contents($arquivo);
    $paises = json_decode($json_data, true);

    // Atualiza os dados com os novos valores
    foreach ($dados as $item) {
        foreach ($paises as &$pais) {
            if ($pais['nome'] === $item['nome']) {
                $pais['medalhas_2020'] = $item['medalhas_2020'];
                $pais['medalhas_2016'] = $item['medalhas_2016'];
            }
        }
    }

    // Salva os dados atualizados de volta no arquivo JSON
    file_put_contents($arquivo, json_encode($paises, JSON_PRETTY_PRINT));

    echo "Dados salvos com sucesso!";
} else {
    echo "Erro ao decodificar o JSON.";
}
?>
