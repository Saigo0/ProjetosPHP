<?php 
    require_once __DIR__ . '/../bootstrap.php';
    class BibliotecarioController{

        public function telaPrincipalBibliotecario(){
            require __DIR__ . '/../view/TelaPrincipalBibliotecario.php';
        }

        public function telaCadastrarLeitor(){
            require __DIR__ . '/../view/TelaCadastrarLeitor.php';
        }

        public function cadastrarLeitor(){
            $leitor = new Leitor();
            $leitor->setNome($_POST['nome']);
            $leitor->setRG($_POST['RG']);
            $leitor->setCPF($_POST['CPF']);
            $leitor->setDataNascimento(DateTime::createFromFormat('Y-m-d', $_POST['dataNascimento']));
            $leitor->setEmail($_POST['email']);
            $leitor->setEndereco($_POST['endereco']);
            $leitor->setTelefone($_POST['telefone']);
            $leitor->setLogin($_POST['login']);
            $leitor->setSenha($_POST['senha']);
            $leitor->setNivelAcesso("Leitor");
            $leitor->setMultasPendentes(0);

            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitorDAO->create($leitor);
            header("Location: ../public/index.php?action=telaprincipal");
            exit;
        }

        public function atualizarLeitor(){
            $leitor = new Leitor();
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitor->setId($_POST['id']);
            $leitor->setNome($_POST['nome']);
            $leitor->setRG($_POST['RG']);
            $leitor->setCPF($_POST['CPF']);
            $leitor->setDataCadastro($leitorDAO->findByID($leitor->getId())->getDataCadastro());
            $leitor->setDataNascimento(new DateTime($_POST['dataNascimento']));
            $leitor->setEmail($_POST['email']);
            $leitor->setEndereco($_POST['endereco']);
            $leitor->setTelefone($_POST['telefone']);
            $leitor->setNivelAcesso($leitorDAO->findByID($leitor->getId())->getNivelAcesso());
            $leitor->setLogin($leitorDAO->findByID($leitor->getId())->getLogin());
            $leitor->setSenha($leitorDAO->findByID($leitor->getId())->getSenha());
            $leitor->setIdUsuario($leitorDAO->findByID($leitor->getId())->getIdUsuario());
            $leitor->setIdPessoa($leitorDAO->findByID($leitor->getId())->getIdPessoa());
            $leitor->setMultasPendentes($leitorDAO->findByID($leitor->getId())->getMultasPendentes());

            
            $leitorDAO->update($leitor);

            header("Location: ../public/index.php?action=gerenciarleitores");
            exit;
        }

        public function listarLeitores(){
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $pessoaDAO = new PessoaDAO(Conexao::getPDO());
            $usuarioDAO = new UsuarioDAO(Conexao::getPDO());
            $leitores =[];
            $arrayAssoLeitor = $leitorDAO->listAll();

            foreach($arrayAssoLeitor as $registroLeitor){
                $leitor = new Leitor();
                $leitor->setId($registroLeitor['id']);
                $leitor->setIdUsuario($usuarioDAO->findByID($registroLeitor['id_usuario'])->getId());
                $leitor->setIdPessoa($usuarioDAO->findByID($registroLeitor['id_pessoa'])->getId());
                $leitores []= $leitor;
            }
            return $leitores;
        }

        public function deletarLeitor(){
            $leitor = new Leitor();
            $leitorDAO = new LeitorDAO(Conexao::getPDO());
            $leitor->setId($leitorDAO->findById($_POST['id'])->getId());
            $leitorDAO->delete($leitor);

            header("Location: ../public/index.php?action=gerenciarleitores");
            exit;
        }

        public function realizarEmprestimo(){
            
        }

    }