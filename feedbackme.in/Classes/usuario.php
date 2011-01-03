<?php

include_once 'mensagem.php';

class Usuario{
	
    private $nome;
    private $email;
    private $senha;
    private $mensagens;
    private $id;
    private $nomedeusuario;

    public function __construct(){
        $this->mensagens = array();
    }


    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getMensagens() {
        return $this->mensagens;
    }

    public function setMensagens($mensagens) {
        $this->mensagens = $mensagens;
    }

    public function adicionarMensagem($mensagem){
        $this->mensagens[] = $mensagem;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
}