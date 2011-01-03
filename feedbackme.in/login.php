<?php 
	include_once 'Classes/usuario.php';
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>FeedbackMe - Login</title>

        <!-- imports -->
        <script type="text/javascript" src="funcoes.js" ></script>
        <link rel="stylesheet" type="text/css" href="style.css" />

    </head>
    <?php
    		session_start();
    		if(isset($_SESSION["usuarioLogado"]))
             $usuario = $_SESSION["usuarioLogado"];
            else 
             $usuario = null;
    ?>
    <body>
        <!--<div class="topo" >
            <p id="logo" ></p>
        </div>-->

        <div class="menu" >
            <div class="logoMenu"></div>
            <ul>
                <li><a href="index.php" >Home</a></li>
                <?php  if ($usuario == null) {?>
                <li><a href="cadastro.php" >Cadastrar</a></li>
                <li><a href="login.php" >Login</a></li>
                <?php } else { ?>
                <li>
                    <a href="manutencaoUsuario.php?tipo=2" >Meu perfil</a>
                </li>
                <!--<li>
                    <a href="cadastroprojeto.jsp" >Cadastrar Projeto</a>
                </li>-->
                <li>
                    <a href="manutencaoUsuario.php?tipo=6" >Logoff</a>
                </li>
                <?php }?>
            </ul>
           <div class="saudacao">Bem-vindo <?php if($usuario == null) echo("visitante!");
                                               else echo($usuario->getNome());
                                             ?>
            </div>
        </div>
       <div class="busca" >
                <form action="manutencaoUsuario.php" method="post">
                    <input type="text" size="50" name="parametro" id="parametro" value="Digite o usuario que quer buscar aqui." onfocus="limpar(this.id)"/>
                    <input type="submit" value="Procurar Usuario" />
                    <input type="hidden" value="3" id="tipo" name="tipo" />
                </form>
        </div>    
        <div class="conteudo" >
            <div class="titulo">
                <img src="imagem/login.png" />
            </div>
            <form action="manutencaoUsuario.php" method="POST" >

                <p>Email: <input type="text" id="email" name="email" /></p>

                <p>Senha: <input type="password" id="senha" name="senha" /></p>

                <p><input type="submit" value="login" onclick="return verificarLogin()"/></p>


                <input type="hidden" value="1" id="tipo" name="tipo" />
            </form>
        </div>
    </body>
</html>
