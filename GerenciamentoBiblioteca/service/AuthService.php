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

            if(password_verify($senhaDigitada, $usuario->getSenha())){
                $nivelAcesso = mb_strtoupper($usuario->getNivelAcesso());
                switch ($nivelAcesso){
                    case mb_strtoupper("LEITOR"):
                        return $this->leitorDAO->findByIdUsuario($idUsuario);
                    
                    case mb_strtoupper("BIBLIOTECARIO"):
                        return $this->bibliotecarioDAO->findByIdUsuario($idUsuario);
                    
                    case mb_strtoupper("ADMINISTRADOR"):
                        return $this->administradorDAO->findByIdUsuario($idUsuario);

                    default:
                        throw new RuntimeException("Nível de acesso não identificado");
                }
            } else{
                echo "Erro password_verify";
            }
            
        }
    }


?>