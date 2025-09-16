<?php 
    class AuthService{
        private UsuarioDAO $usuarioDAO;

        public function __construct(UsuarioDAO $usuarioDAO)
        {
            $this->usuarioDAO = $usuarioDAO;
        }

        public function autenticar(string $login, string $senhaDigitada){
            $usuario = $this->usuarioDAO->findByLogin($login);

            
            if($usuario == null){
                return false;
            } 

            return password_verify($senhaDigitada, $usuario->getSenha());
        }
    }


?>