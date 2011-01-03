<?php 
	include_once 'Classes/usuario.php';
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
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
                <img src="imagem/meuperfil.png" />
            </div>
            <p>Nome: <?php echo $usuario->getNome(); ?></p>
            <p>Email: <?php echo $usuario->getEmail(); ?></p>
            <br><br>
            <hr>
            <br><br>
            <img src="imagem/feedbacks.png"/>
            
                <?php 
                            $mensagens = $usuario->getMensagens();
							
                            for($i = 0 ; $i < count($mensagens) ; $i++){
                            
                                echo("<fieldset><legend>" . $mensagens[$i]->getAutor() . "</legend>"
                                        . "<p> \"" . $mensagens[$i]->getPalavra1() . ". ");
                                echo($mensagens[$i]->getPalavra2() . ". ");
                                echo($mensagens[$i]->getPalavra3() . ".\" </p>");
                                echo("<p><cite> " . $mensagens[$i]->getMensagem() . " </cite></p>");
                                //out.print("<p>Enviada por " + mensagem.getAutor());
                                echo("</fieldset><br><br>");
                            }
                ?>
        </div>
    </body>
</html>
