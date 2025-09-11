<?php 
    class BibliotecarioDAO{
        private PDO $pdo;
        private UsuarioDAO $usuarioDAO;

        public function __construct(PDO $pdo)
        {
            $this->usuarioDAO = new UsuarioDAO($pdo);
            $this->pdo = $pdo;
        }

        public function create(Bibliotecario $bibliotecario){

            $usuario = $bibliotecario;
            $idUsuario = $this->usuarioDAO->create($usuario);
            
            $bibliotecario->setIdUsuario($idUsuario);

            $sql = "INSERT INTO bibliotecario (id_usuario, registroCRB, valorCRB) VALUES (:id_usuario, :registroCRB, :valorCRB)";
            $stmt = $this->pdo->prepare($sql);
        }

        public function update(Bibliotecario $bibliotecario){
            
        }
    }
?>