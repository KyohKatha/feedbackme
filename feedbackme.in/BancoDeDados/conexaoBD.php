<?php 

include_once 'Classes/usuario.php';

class ConexaoBD {

    private static $m_pInstance;
    private $con;
    private $stm;

    private function __construct(){
    	
    	$this->host = 'localhost';
        $this->login = 'root';
        $this->password = 'root';
        $this->db = 'feedbackme';
        $this->link = '';
        $this->consult = '';
        
        $this->link = mysql_connect($this->host, $this->login, $this->password) 
        	or die("Could not connect to MySQL database");
        mysql_select_db($this->db);
        	
    }

    public static function getInstance(){ 
    	if (!self::$m_pInstance){  
        	self::$m_pInstance = new ConexaoBD(); 
    		
    	}
    	return self::$m_pInstance; 
	} 

    public function cadastrarUsuario($nvUsuario) {
        $consulta = "";
        $consulta .= "INSERT INTO usuario VALUES (0,";
        $consulta .= "'" . $nvUsuario->getNome() . "',";
        $consulta .= "'" . $nvUsuario->getEmail() . "',";
        $consulta .= "'" . $nvUsuario->getSenha() . "')";
        echo("consulta ==> " . $consulta);
        mysql_query($consulta, $this->link);
        return true;
    }

    public function verificarSenhaUsuario($nvUsuario) {
        $consulta = "";
        $consulta .= "SELECT idusuario, nome, senha FROM usuario WHERE email = '" . $nvUsuario->getEmail() . "'";

        echo("consulta ==> " . $consulta);
        $rs = null;
        try {
            $rs = mysql_query($consulta, $this->link);
            while ($int = mysql_fetch_assoc($rs)) {
                if ($int["senha"] != $nvUsuario->getSenha()) {
                    return null;
                }
                $nvUsuario->setNome($int["nome"]);
                $nvUsuario->setId($int["idusuario"]);
            }

        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
		echo $nvUsuario->getNome();
        return $nvUsuario;
    }

    public function buscarMensagensUsuario($usuario) {
        $mensagens = new Mensagem();
        //mensagens.put("Você é muito inteligente!", "José");
        //mensagens.put("Você precisa se concentrar mais em suas tarefas.", "Anônimo");

		$arrayMsg = array();
        $idusuario = self::consultarIdUsuario($usuario->getEmail());
        
        if($idusuario == -1){
            echo("Erro ao procurar id do usuario");
            return $mensagens;
        }
        $consulta = "SELECT * FROM mensagem WHERE idusuario = " . $idusuario;
		
        try {
            $rs = mysql_query($consulta, $this->link);

            while ($int = @mysql_fetch_assoc($rs)) {
                $mensagens->setAutor($int["autor"]);
                $mensagens->setMensagem($int["mensagem"]);
                $mensagens->setPalavra1($int["palavra1"]);
                $mensagens->setPalavra2($int["palavra2"]);
                $mensagens->setPalavra3($int["palavra3"]);
				$arrayMsg[] = $mensagens;
            }
            

        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
        return $arrayMsg;
    }

    public function buscarUsuario($parametro) {
        $usuarios = array();

        //aux.setNome("Testes");
        //aux.setEmail("Testes@testes.com");

        $consulta = "SELECT idusuario, email, nome FROM usuario WHERE email LIKE '%" . $parametro . "%' OR nome LIKE '%" . $parametro . "%'";
        try {
            $rs = mysql_query($consulta, $this->link);
            while ($int = @mysql_fetch_assoc($rs)) {
                $aux = new Usuario();
                $aux->setEmail($int["email"]);
                $aux->setNome($int["nome"]);
                $aux->setId($int["idusuario"]);
                $usuarios[] = $aux;
            }

        } catch (Exception $e) {
            $e->getMessage();
        }

        return $usuarios;
    }

	public function adicionarMensagem($usuario, $mensagem, $postador) {
        $idusuario = self::consultarIdUsuario($usuario->getEmail());

        $consulta = "INSERT INTO mensagem VALUES (0,"
                . $idusuario . ",'" . $mensagem->getMensagem() . "',"
                . "'" . $mensagem->getAutor() . "', " . $postador->getId() . ", "
                . "'" . $mensagem->getPalavra1() . "', '" . $mensagem->getPalavra2() . "', '" . $mensagem->getPalavra3() . "')";

		echo $consulta;		
        try{
            mysql_query($consulta, $this->link);
        }catch(Exception $e){
            echo $e->getMessage();
        }

        return true;
    }

    private function consultarIdUsuario($email) {
        $consulta = "SELECT idusuario FROM usuario WHERE email = '" . $email . "'";
        
        $idusuario = -1;
        try {
            $rs = mysql_query($consulta, $this->link);
            while ($int = @mysql_fetch_assoc($rs)) {
                $idusuario = $int["idusuario"];
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $idusuario;
    }
    
 public function cadastrarProjeto($nvProjeto) {
        $consulta = "";
        $consulta .= "INSERT INTO projeto VALUES (0,";
        $consulta .= $nvProjeto->getIdusuario() . ",";
        $consulta .= "'" . $nvProjeto->getNome() . "',";
        $consulta .= "'" . $nvProjeto->getDescricao() . "',";
        $consulta .= "'" . $nvProjeto->getLink(). "')";
        
        try {
            mysql_query($consulta, $this->link);
        } catch (Exception $e) {
            $e->getMessage();
            return false;
        }

        return true;
    }
}
