<?php 
    class AuthService{
        private UsuarioDAO $usuarioDAO;
        private LeitorDAO $leitorDAO;
        private BibliotecarioDAO $bibliotecarioDAO;
        private AdministradorDAO $administradorDAO;

        public function __construct()
        {
            $this->usuarioDAO = new UsuarioDAO(Conexao::getPDO());
            $this->leitorDAO = new LeitorDAO(Conexao::getPDO());
            $this->bibliotecarioDAO = new BibliotecarioDAO(Conexao::getPDO());
            $this->administradorDAO = new AdministradorDAO(Conexao::getPDO());
        }

        public function autenticar(string $login, string $senhaDigitada){
            
            $usuario = $this->usuarioDAO->findByLogin($login);
            $idUsuario = $usuario->getId();

            
            if($usuario == null){
                return false;
            } 

            if(!password_verify($senhaDigitada, $usuario->getSenha())){
                throw new InvalidArgumentException("Verificação da senha aponta discrepância entre a senha digitada e a senha correta");
            } 

            if(session_status() !== PHP_SESSION_ACTIVE){
                session_start([
                    'cookie_httponly' => true,
                    'cookie_secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
                    'cookie_samesite' => 'Lax',
                    'use_strict_mode' => true
                ]);
            }

            session_regenerate_id(true);

            $_SESSION['idUsuario'] = $usuario->getId();
            $_SESSION['nivelAcesso'] = $usuario->getNivelAcesso();
            $_SESSION['last_activity'] = time();
            $_SESSION['created'] = time();

            $nivelAcesso = mb_strtoupper($usuario->getNivelAcesso());
            switch ($nivelAcesso){
                    case mb_strtoupper("LEITOR"):
                        $leitor = $this->leitorDAO->findByIdUsuario($idUsuario);
                        $_SESSION['idPerfil'] = $leitor->getId();
                        break;
                    
                    case mb_strtoupper("BIBLIOTECARIO"):
                        $bibliotecario = $this->bibliotecarioDAO->findByIdUsuario($idUsuario);
                        $_SESSION['idPerfil'] = $bibliotecario->getId();
                        break;
                    
                    case mb_strtoupper("ADMINISTRADOR"):
                        $administrador = $this->administradorDAO->findByIdUsuario($idUsuario);
                        $_SESSION['idPerfil'] = $administrador->getId();
                        break;

                    default:
                        throw new RuntimeException("Nível de acesso não identificado");
            }
            return true;
        }

        public function logout(){
            session_start();
            $_SESSION = [];
            if(ini_get('session.use_cookies')){
                $p = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $p['path'], $p['domain'], $p['secure'], $p['httponly']
                );
            }
            session_destroy();
        }
    }


?>