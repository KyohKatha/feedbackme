<?php 

class Mensagem {
    private $autor;
    private $palavra1, $palavra2, $palavra3;
    private $mensagem;

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function getPalavra1() {
        return $this->palavra1;
    }

    public function setPalavra1($palavra1) {
        $this->palavra1 = $palavra1;
    }
    
	public function getPalavra2() {
        return $this->palavra2;
    }

    public function setPalavra2($palavra2) {
        $this->palavra2 = $palavra2;
    }
   
	public function getPalavra3() {
        return $this->palavra3;
    }

    public function setPalavra3($palavra3) {
        $this->palavra3 = $palavra3;
    }
    
}

?>