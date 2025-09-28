<?php 
    require_once __DIR__ . '/../bootstrap.php';
    class UsuarioController{

        public function criarUsuario(){
            $usuario = new Usuario();
            $usuarioDao = new UsuarioDAO(Conexao::getPDO());
            $usuario->setLogin($_POST['login']);
            $usuario->setNivelAcesso($_POST['nivelAcesso']);
            $usuario->setSenha($_POST['senha']);
            
            $usuarioDao->create($usuario);
        }

        public function atualizarUsuario(){
            $usuarioDAO = new UsuarioDAO(Conexao::getPDO());
            $usuario = new Usuario();

            $usuario->setLogin($_POST['novoLogin']);
            $usuario->setNivelAcesso($_POST['novoNivelAcesso']);
            $usuario->setSenha($_POST['novaSenha']);
            $usuario->setDataCadastro($_POST['novaDataCadastro']);

            return $usuarioDAO->update($usuario);
        }

        public function listarUsuarios(){
            $usuarioDao = new UsuarioDAO(Conexao::getPDO());
            $usuarios = $usuarioDao->listAll();
            return $usuarios; 
        }

        public function deletarUsuario(){
            $usuarioDAO = new UsuarioDAO(Conexao::getPDO());
            $usuario = new Usuario();
            $usuario->setId($_POST['id']);
            return $usuarioDAO->delete($usuario);
        }

        public function autenticarUsuario(){
            $usuarioDao = new UsuarioDAO(Conexao::getPDO());
            $serviceAuteticacao = new AuthService($usuarioDao);
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            if($serviceAuteticacao->autenticar($login, $senha)){
                $_SESSION['usuario'] = $login;
            }
        }
    }

?>