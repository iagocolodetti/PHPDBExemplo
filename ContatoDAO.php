<?php

/**
 *
 * @author iagocolodetti
 */

require_once 'Contato.php';
require_once 'Connection.php';

class ContatoDAO {
    
    public function adicionar($contato) {
        $conn = Connection::getConnection();
        
        $retorno = "";
        
        if ($conn != null) {
            $sql = "INSERT INTO Contato (nome, telefone, email) VALUES ('" . $contato->getNome() . "', '" . $contato->getTelefone() . "', '" . $contato->getEmail() . "')";
            if (!$conn->query($sql)) {
                //$retorno = $conn->error;
                $retorno = "erroSQL";
            }
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
    
    public function buscarPorID($id) {
        $conn = Connection::getConnection();
        
        $retorno = "";
        
        if ($conn != null) {
            $sql = "SELECT * FROM Contato WHERE id = '" . $id . "'";
            if ($resultado = $conn->query($sql)) {
                if ($resultado->num_rows == 1) {
                    $l = $resultado->fetch_assoc();
                    $retorno = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $conn->error;
                $retorno = "erroSQL";
            }
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
    
    public function buscarPorNome($nome) {
        $conn = Connection::getConnection();
        
        $retorno = "";
        
        if ($conn != null) {
            $sql = "SELECT * FROM Contato WHERE nome LIKE '%" . $nome . "%'";
            if ($resultado = $conn->query($sql)) {
                if ($resultado->num_rows > 0) {
                    while($l = $resultado->fetch_assoc()) {
                        $contato[] = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                    }
                    $retorno = $contato;
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $conn->error;
                $retorno = "erroSQL";
            }
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
    
    public function buscarPorTelefone($telefone) {
        $conn = Connection::getConnection();
        
        $retorno = "";
        
        if ($conn != null) {
            $sql = "SELECT * FROM Contato WHERE telefone LIKE '%" . $telefone . "%'";
            if ($resultado = $conn->query($sql)) {
                if ($resultado->num_rows > 0) {
                    while($l = $resultado->fetch_assoc()) {
                        $contato[] = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                    }
                    $retorno = $contato;
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $conn->error;
                $retorno = "erroSQL";
            }
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
    
    public function buscarPorEmail($email) {
        $conn = Connection::getConnection();
        
        $retorno = "";
        
        if ($conn != null) {
            $sql = "SELECT * FROM Contato WHERE email LIKE '%" . $email . "%'";
            if ($resultado = $conn->query($sql)) {
                if ($resultado->num_rows > 0) {
                    while($l = $resultado->fetch_assoc()) {
                        $contato[] = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                    }
                    $retorno = $contato;
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $conn->error;
                $retorno = "erroSQL";
            }
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
    
    public function buscarTodos() {
        $conn = Connection::getConnection();
        
        $retorno = "";
        
        if ($conn != null) {
            $sql = "SELECT * FROM Contato";
            if ($resultado = $conn->query($sql)) {
                if ($resultado->num_rows > 0) {
                    while($l = $resultado->fetch_assoc()) {
                        $contato[] = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                    }
                    $retorno = $contato;
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $conn->error;
                $retorno = "erroSQL";
            }
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
    
    public function alterar($contato) {
        $conn = Connection::getConnection();
        
        $retorno = "";
        
        if ($conn != null) {
            $sql = "UPDATE Contato SET ";
            if ($contato->getNome() != "" && $contato->getTelefone() != "" && $contato->getEmail() != "") {
                $sql .= "nome = '" . $contato->getNome() . "', telefone = '" . $contato->getTelefone() . "', email = '" . $contato->getEmail() . "'";
            } elseif ($contato->getNome() != "" && $contato->getTelefone() != "") {
                $sql .= "nome = '" . $contato->getNome() . "', telefone = '" . $contato->getTelefone() . "'";
            } elseif ($contato->getNome() != "" && $contato->getEmail() != "") {
                $sql .= "nome = '" . $contato->getNome() . "', email = '" . $contato->getEmail() . "'";
            } elseif ($contato->getTelefone() != "" && $contato->getEmail() != "") {
                $sql .= "telefone = '" . $contato->getTelefone() . "', email = '" . $contato->getEmail() . "'";
            } elseif ($contato->getNome()) {
                $sql .= "nome = '" . $contato->getNome() . "'";
            } elseif ($contato->getTelefone()) {
                $sql .= "telefone = '" . $contato->getTelefone() . "'";
            } elseif ($contato->getEmail()) {
                $sql .= "email = '" . $contato->getEmail() . "'";
            }
            $sql .= " WHERE id = '" . $contato->getID() . "'";
            if ($conn->query($sql)) {
                if ($conn->affected_rows == 0) {
                    $retorno = "erroUP";
                }
            } else {
                //$retorno = $conn->error;
                $retorno = "erroSQL";
            }
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
    
    public function deletar($id) {
        $conn = Connection::getConnection();
        
        $retorno = "";
        
        if ($conn != null) {
            $sql = "DELETE FROM Contato WHERE id = '" . $id . "'";
            if ($conn->query($sql)) {
                if ($conn->affected_rows == 0) {
                    $retorno = "erroDEL";
                }
            } else {
                //$retorno = $conn->error;
                $retorno = "erroSQL";
            }
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
}
