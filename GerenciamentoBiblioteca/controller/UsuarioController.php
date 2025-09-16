<?php 
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
            $arrayAsso = $usuarioDao->listAll();
            $usuarios = [];
            foreach($arrayAsso as $registroUsuario){
                switch($registroUsuario['nivelAcesso']){
                    case mb_strtoupper('LEITOR'):
                        $usuario = new Leitor();
                        break;

                    case mb_strtoupper('BIBLIOTECARIO'):
                        $usuario = new Bibliotecario();
                        break;
                    
                    case mb_strtoupper('ADMINISTRADOR'):
                        $usuario = new Administrador();
                        break;
                    
                    default:
                        throw new RuntimeException("Tipo de usuário não identificado: $registroUsuario");
                }

                $usuario->setId($arrayAsso['id']);
                $usuario->setIdPessoa($arrayAsso['id_pessoa']);
                $usuario->setLogin($arrayAsso['login']);
                $usuario->setNivelAcesso($arrayAsso['nivelAcesso']);
                $usuario->setSenha($arrayAsso['senha']);
                $usuario->setDataCadastro($arrayAsso['dataCadastro']);

                $usuarios[] = $usuario;
            }

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