<?php

include_once 'Classes/usuario.php';
include_once 'BancoDeDados/conexaoBD.php';
include_once 'Classes/mensagem.php';

class ManutencaoUsuario {
		
		 public function cadastrarUsuario(){
        
			$nvUsuario = new Usuario();

        	$nvUsuario->setNome($_POST["nome"]);
                $nvUsuario->setNomeUsuario($_POST["nomeUsuario"]);
        	$nvUsuario->setEmail($_POST["email"]);
        	$nvUsuario->setSenha($_POST["senha"]);
        	
        	try {
         	   $con = ConexaoBD::getInstance();
         	 
         	   if ($con->cadastrarUsuario($nvUsuario)) {
                     self::logarUsuario();
            	} else {
                $erro = base64_encode("Nome de usuário já existe, por favor, escolha outro.");
                @header("Location: cadastro.php?msn=$erro");
            }

        } catch (Exception $e) {
            echo("Erro ao acessar o banco de dados, para cadastro do usuario");
            @header("Location: cadastro.php");
        }
    }

    public function logarUsuario(){
        $nvUsuario = new usuario();
        $nvUsuario->setEmail($_POST["email"]);
        $nvUsuario->setSenha($_POST["senha"]);

        try {
            $con = ConexaoBD::getInstance();
            $userR = $con->verificarSenhaUsuario($nvUsuario);
            if ($userR != null) {
                echo("Senha Correta!!");
                session_start();
                $_SESSION["usuarioLogado"] = $userR;
                @header("Location: meuperfil.php");
            } else {
                $erro = base64_encode("Login ou senha incorretos, por favor, tente novamente.");
                @header("Location: login.php?msn=$erro");
            }

        } catch (Exception $e) {
            echo("Erro ao acessar o banco de dados, para logar o usuario");
            @header("Location: login.php");
        }
      
    }

    public function exibirPerfilLogado(){
    	session_start();
        $usuario = $_SESSION["usuarioLogado"];
        
        try {
            $con = ConexaoBD::getInstance();
            $mensagens = $con->buscarMensagensUsuario($usuario);
			
            $usuario->setMensagens($mensagens);
            $_SESSION["usuarioLogado"] =  $usuario;
            @header("Location: meuperfil.php");

        } catch (Exception $e) {
            echo("Erro ao acessar o banco de dados, para exibir perfil do usuario");
            @header("Location: index.php");
        }
        
    }

    public function buscarUsuario(){
    	session_start();
        $parametro = $_POST["parametro"];
        $_SESSION["parametro"] = $parametro;

        try {
            $con = ConexaoBD::getInstance();
            $usuarios = $con->buscarUsuario($parametro);
            $_SESSION["resultadoBusca"] = $usuarios;
            @header("Location: resultadobusca.php");
        } catch (Exception $e) {
            echo("Erro ao acessar o banco de dados, para buscar usuario " + parametro);
            @header("Location: index.php");
        }

    }

    public function selecionarUsuario(){
    	session_start();
        $usuarios = $_SESSION["resultadoBusca"];
        $i = $_GET["i"];
        $selecionado = $usuarios[$i];

        try {
            $con = ConexaoBD::getInstance();
            $selecionado->setMensagens($con->buscarMensagensUsuario($selecionado));

            $_SESSION["selecionado"] = $selecionado;
            @header("Location: perfilusuario.php");
        } catch (Exception $e) {
            echo("Erro ao acessar o banco de dados, para buscar mensagens do usuario selecionado");
            @header("Location: resultadobusca.php");
        }
    }

    public function adicionarMensagem(){
    	session_start();
		$usuario = $_SESSION["selecionado"];
		$usuarioLogado = $_SESSION["usuarioLogado"];
		
        $autorAux = $_POST["anonimo"];
		if($autorAux == "on")
			$autorAux = "anonimo";
		else
			$autorAux = $usuarioLogado->getNome();
        $mensagem = $_POST["mensagem"];
        $palavra1 = $_POST["palavra1"];
        $palavra2 = $_POST["palavra2"];
        $palavra3 = $_POST["palavra3"];
        
        

        if ($autorAux == null) {
            
            $autor = $usuarioLogado->getNome();
            $usuario->adicionarMensagem($mensagem, $autor);
        } else {
            $autor = "An�nimo";
            $usuario->adicionarMensagem($mensagem, $autor);
        }
        
        $m = new Mensagem();
        $m->setAutor($autorAux);
        $m->setMensagem($mensagem);
        $m->setPalavra1($palavra1);
        $m->setPalavra2($palavra2);
        $m->setPalavra3($palavra3);
        
        $usuario->adicionarMensagem($m);

        try {
            $con = ConexaoBD::getInstance();
            if ($con->adicionarMensagem($usuario, $m, $usuarioLogado)) {
                echo("Mensagem adicionada com sucesso");
            } else {
                echo("Erro ao adicionar mensagem");
            }

        } catch (Exception $e) {
            echo("Erro ao acessar o banco de dados, para buscar adicionar mensagem");
        }
        @header("Location: perfilusuario.php");
    }

    public function logoff(){
        session_start();
    	$_SESSION = array(); 
		session_destroy(); 
		unset($_SESSION);
        @header("Location: index.php");
    }
    
	private function cadastrarProjeto(){
        $nvProjeto = new Projeto();
		session_start();
        $usuarioLogado = $_SESSION["usuarioLogado"];

        $nvProjeto->setNome($_POST["nome"]);
        $nvProjeto->setDescricao($_POST["descricao"]);
        $nvProjeto->setLink($_POST["link"]);
        $nvProjeto->setIdusuario($usuarioLogado->getId());
        
        try {
            $con = ConexaoBD::getInstance();
            if ($con->cadastrarProjeto($nvProjeto)) {
                echo("Cadastro de usuario OK");
                @header("Location: index.php");
            } else {
                echo("Cadastro de usuario com problema");
                @header("Location: cadastroprojeto.php");
            }

        } catch (Exception $e) {
            echo("Erro ao acessar o banco de dados, para cadastro do usuario");
            @header("Location: cadastroprojeto.php");
        }
    }
}		 
		$tipo = null;
		if(!empty($_POST["tipo"]))
			$tipo = $_POST["tipo"];
		else
			$tipo = $_GET["tipo"];
		$contrl = new ManutencaoUsuario();
		switch ($tipo) {
                case 0:
                    $contrl->cadastrarUsuario();
                    break;
                case 1:
                    $contrl->logarUsuario();
                    break;
                case 2:
                    $contrl->exibirPerfilLogado();
                    break;
                case 3:
                    $contrl->buscarUsuario();
                    break;
                case 4:
                    $contrl->selecionarUsuario();
                    break;
                case 5:
                    $contrl->adicionarMensagem();
                    break;
                case 6:
                    $contrl->logoff();
            }
?>