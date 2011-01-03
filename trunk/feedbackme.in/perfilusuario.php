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
             
             if(isset($_SESSION["selecionado"]))
             $usuarioSel = $_SESSION["selecionado"];
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
                    <img src="imagem/perfilde.png" /><h2><?php $usuarioSel->getNome() ?> - <?php $usuarioSel->getEmail() ?></h2>
            </div>
            
            <hr>
            <div class="envioMensagem" >
            <form action="manutencaoUsuario.php" method="post">
                <label>Defina <?php echo $usuarioSel->getNome() ?> em 3 palavras!</label><p>
                    <input type="text" name="palavra1" id="palavra1" />
                    <input type="text" name="palavra2" id="palavra2" />
                    <input type="text" name="palavra3" id="palavra3" /></p>
                <label>Deixe um feedback para <?php echo $usuarioSel->getNome() ?>!</label>
                <p><textarea cols="40" rows="8" value="Digite um feedback para o usuário aqui." name="mensagem" id="mensagem" onfocus="limpar(this.id)" ></textarea></p>
                <input type="checkbox" name="anonimo" id="anonimo" checked="checked" /> Postar como anônimo
                <input type="submit" value="Enviar Mensagem" />
                <input type="hidden" value="5" id="tipo" name="tipo" />
            </form>
                </div>
            
            <div class="mensagem" >
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
            
        </div>
    </body>
</html>
