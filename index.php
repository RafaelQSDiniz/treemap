<?php
include "processamento.php";
ob_clean();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Grafico Treemap</title>
</head>
<body>
    <div class="container">
        <div class="div_grafico">   
            <h1>Medalhas em 2020</h1>
            <div class="grafico">
                <?php 
                    foreach ($paises as $pais) {
                        echo '<div class="item" 
                                style="background-color:'.htmlspecialchars($pais->cor).';
                                width:'.htmlspecialchars($pais->largura).'px;
                                height:'.htmlspecialchars($pais->altura).'px;
                                top:'.htmlspecialchars($pais->eixo_y).'px;
                                left:'.htmlspecialchars($pais->eixo_x).'px;
                                ">' . htmlspecialchars($pais->nome) . '
                                    <div>🥇'.htmlspecialchars($pais->medalhas_2020) .'</div>
                            </div>';
                        
                    }
                ?>
            </div>

        </div>
        <div class="div_tabela">
            <h1>Histórico</h1>
            <div class="tabela">
                <table>
                    <thead>
                        <tr>
                            <th>País</th>
                            <th>Tokyo 2020</th>
                            <th>Rio 2016</th>
                            <th>Crescimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($paises as $pais) {
                            echo '<tr>
                                    <td class="nomes">'.htmlspecialchars($pais->nome).'</td>
                                    <td>'.htmlspecialchars($pais->medalhas_2020).'</td>
                                    <td>'.htmlspecialchars($pais->medalhas_2016).'</td>
                                    <td>'.htmlspecialchars(number_format($pais->variacao),0).'%</td>
                                </tr>';
                        }?>
                    </tbody>
                </table>
            </div>
            <a href="alterar.html" style="margin:0 auto;">
                    <button>Alterar <img src="icon.png" alt="" width="30px"></button>
            </a>
        </div>

    </div>
</body>
</html>