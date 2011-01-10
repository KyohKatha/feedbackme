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


     <body onload="iniciar()">
        <!--<div class="topo" >
            <p id="logo" ></p>
        </div>-->

        <div class="menu" >
            <div class="logoMenu"></div>
            <ul>
                <li><table><tr><td><img alt="home" src="imagem/home.png"/></td>
                            <td><a href="index.php" >Home</a></td></tr></table>
                </li>
                <?php if ($usuario == null) {
                ?>
                    <li><table><tr><td><img src="imagem/cadastroIcon.png"/></td>
                                <td> <a href="cadastro.php"> Cadastrar</a></td></tr></table>
                    </li>
                    <li onclick="mostrarLogin()" ondblclick="esconderLogin()"><table><tr><td><img src="imagem/loginIcon.png"/></td>
                                <td><a href="login.php" >Login</a>

                        <form id="login" style="z-index: 2; position:absolute" action="manutencaoUsuario.php" method="POST" >
                            <table><tr><td>Email: </td><td><input type="text" id="email" name="email" /></td></tr>
                            <tr><td>Senha: </td><td><input type="password" id="senha" name="senha" /></td></tr>
                            <tr><td align="right" colspan="3"><input type="submit" value="login" onclick="return verificarLogin()"/></td></tr>
                            </table>
                            <input type="hidden" value="1" id="tipo" name="tipo" />
                        </form>
                        </table></li>

                <?php } else {
                ?>
                    <li>
                        <table><tr><td><img src="imagem/perfilIcon.png"/></td>
                                <td> <a href="manutencaoUsuario.php?tipo=2" >Meu perfil</a></td></tr></table>
                    </li>
                    <!--<li>
                        <a href="cadastroprojeto.jsp" >Cadastrar Projeto</a>
                    </li>-->
                    <li>
                         <table><tr><td><img src="imagem/logoffIcon.png"/></td>
                                <td> <a href="manutencaoUsuario.php?tipo=6" >Logoff</a></td></tr></table>
                    </li>
                <?php } ?>
                <li>
                    <table><tr><td><img src="imagem/contatoIcon.png"/></td>
                            <td> <a href="contato.php"> Contato</a></td></tr></table>
                </li>
            </ul>
            <div class="saudacao">Bem-vindo <?php
                if ($usuario == null)
                    echo("visitante!");
                else
                    echo($usuario->getNome());
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
        
            
            <div class="menuPerfil">
            <img src="http://s3.amazonaws.com/profile-pic-image/other_1_big.gif" />
            <p><strong> <?php echo $usuarioSel->getNome(); ?></strong></p>
            <p> <?php echo $usuarioSel->getEmail(); ?> </p>
            <br><br>
            <hr>
            <br><br>
            </div>
        <h1>Deixe um Feedback para <?php echo $usuarioSel->getNome() ?>! </h1>
            <hr>
            <fieldset class="envioMensagem" >
            <form action="manutencaoUsuario.php" method="post">
                <label>Defina <?php echo $usuarioSel->getNome() ?> em 3 palavras!</label><p>
                    <input type="text" name="palavra1" id="palavra1" />
                    <input type="text" name="palavra2" id="palavra2" />
                    <input type="text" name="palavra3" id="palavra3" /></p>
                <label>Deixe uma mensagem para <?php echo $usuarioSel->getNome() ?>!</label>
                <p><textarea cols="40" rows="8" value="Digite um feedback para o usu�rio aqui." name="mensagem" id="mensagem" onfocus="limpar(this.id)" ></textarea></p>
                <input type="checkbox" name="anonimo" id="anonimo" checked="checked" /> Postar como an�nimo
                <input type="submit" value="Enviar Mensagem" />
                <input type="hidden" value="5" id="tipo" name="tipo" />
            </form>
                </fieldset>
            <!--
            <div class="mensagem" >
            <img src="imagem/feedbacks.png"/>
            -->
               <?php
               /*
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
                *
                */
                ?>
            <!--</div>-->
            
        
        <div class="rodape" >Criado por Katharina Garcia e Renato Molina</div>
    </body>
</html>
