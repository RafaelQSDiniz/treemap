<?php
class Pais {
    public $nome;
    public $medalhas_2020;
    public $medalhas_2016;
    public $variacao;
    public $cor;

    public function __construct($nome, $medalhas_2020, $medalhas_2016) {
        $this->nome = $nome;
        $this->medalhas_2020 = $medalhas_2020;
        $this->medalhas_2016 = $medalhas_2016;
        $this->calcularVariacao();
        $this->definirCor();
    }

    private function calcularVariacao() {
        $this->variacao = (($this->medalhas_2020 - $this->medalhas_2016) / $this->medalhas_2016) * 100;
    }

    private function definirCor() {
        if ($this->variacao > 50) {
            $this->cor = '#1c500b';
        } elseif ($this->variacao > 50) {    
            $this->cor = '#256b0e';
        } elseif ($this->variacao > 30) {    
            $this->cor = '#267d0a';
        } elseif ($this->variacao >= 15) {
            $this->cor = '#3e931f';
        } elseif ($this->variacao >= 0) {
            $this->cor = '#59ac35';
        } elseif ($this->variacao >= -10) {
            $this->cor = '#ef686a';
        } elseif ($this->variacao >= -20) {
            $this->cor = '#d23938';
        } else {
            $this->cor = '#a40305';
        }
    }

    public function exibirDetalhes() {
        echo "País: " . $this->nome . "<br>";
        echo "Medalhas 2020: " . $this->medalhas_2020 . "<br>";
//        echo "Medalhas 2016: " . $this->medalhas_2016 . "<br>";
//        echo "Variação: " . number_format($this->variacao, 2) . "%<br>";
        echo "Cor: " . $this->cor . "<br>";
//        echo "Relativo: " . number_format($this->relativo,2) . "%<br>";
        echo "ALTURA: " . number_format($this->altura, 0) ." LARGURA:".number_format($this->largura, 0)."<br>";
        echo "X: " . number_format($this->eixo_x, 0) ." / Y: " . number_format($this->eixo_y, 0) . "<br>";
        echo "-----------------------<br>";
    }
}

?>
