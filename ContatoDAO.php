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
            $stmt = $conn->prepare("INSERT INTO Contato (nome, telefone, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $contato->getNome(), $contato->getTelefone(), $contato->getEmail());
            if (!$stmt->execute()) {
                //$retorno = $stmt->error;
                $retorno = "erroSQL";
            }
            $stmt->close();
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
            $stmt = $conn->prepare("SELECT * FROM Contato WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                if ($resultado->num_rows == 1) {
                    $l = $resultado->fetch_assoc();
                    $retorno = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $stmt->error;
                $retorno = "erroSQL";
            }
            $stmt->close();
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
            $stmt = $conn->prepare("SELECT * FROM Contato WHERE nome LIKE ?");
            $parteNome = "%" . $nome . "%";
            $stmt->bind_param("s", $parteNome);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                if ($resultado->num_rows > 0) {
                    while($l = $resultado->fetch_assoc()) {
                        $contato[] = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                    }
                    $retorno = $contato;
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $stmt->error;
                $retorno = "erroSQL"; 
            }
            $stmt->close();
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
            $stmt = $conn->prepare("SELECT * FROM Contato WHERE telefone LIKE ?");
            $parteTelefone = "%" . $telefone . "%";
            $stmt->bind_param("s", $parteTelefone);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                if ($resultado->num_rows > 0) {
                    while($l = $resultado->fetch_assoc()) {
                        $contato[] = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                    }
                    $retorno = $contato;
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $stmt->error;
                $retorno = "erroSQL"; 
            }
            $stmt->close();
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
            $stmt = $conn->prepare("SELECT * FROM Contato WHERE email LIKE ?");
            $parteEmail = "%" . $email . "%";
            $stmt->bind_param("s", $parteEmail);
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                if ($resultado->num_rows > 0) {
                    while($l = $resultado->fetch_assoc()) {
                        $contato[] = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                    }
                    $retorno = $contato;
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $stmt->error;
                $retorno = "erroSQL"; 
            }
            $stmt->close();
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
            $stmt = $conn->prepare("SELECT * FROM Contato");
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                if ($resultado->num_rows > 0) {
                    while($l = $resultado->fetch_assoc()) {
                        $contato[] = new Contato($l["id"], $l["nome"], $l["telefone"], $l["email"]);
                    }
                    $retorno = $contato;
                } else {
                    $retorno = null;
                }
            } else {
                //$retorno = $stmt->error;
                $retorno = "erroSQL"; 
            }
            $stmt->close();
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
            if ($contato->getNome() != "" && $contato->getTelefone() != "" && $contato->getEmail() != "") {
                $stmt = $conn->prepare("UPDATE Contato SET nome = ?, telefone = ?, email = ? WHERE id = ?");
                $stmt->bind_param("sssi", $contato->getNome(), $contato->getTelefone(), $contato->getEmail(), $contato->getID());
            } elseif ($contato->getNome() != "" && $contato->getTelefone() != "") {
                $stmt = $conn->prepare("UPDATE Contato SET nome = ?, telefone = ? WHERE id = ?");
                $stmt->bind_param("ssi", $contato->getNome(), $contato->getTelefone(), $contato->getID());
            } elseif ($contato->getNome() != "" && $contato->getEmail() != "") {
                $stmt = $conn->prepare("UPDATE Contato SET nome = ?, email = ? WHERE id = ?");
                $stmt->bind_param("ssi", $contato->getNome(), $contato->getEmail(), $contato->getID());
            } elseif ($contato->getTelefone() != "" && $contato->getEmail() != "") {
                $stmt = $conn->prepare("UPDATE Contato SET telefone = ?, email = ? WHERE id = ?");
                $stmt->bind_param("ssi", $contato->getTelefone(), $contato->getEmail(), $contato->getID());
            } elseif ($contato->getNome() != "") {
                $stmt = $conn->prepare("UPDATE Contato SET nome = ? WHERE id = ?");
                $stmt->bind_param("si", $contato->getNome(), $contato->getID());
            } elseif ($contato->getTelefone() != "") {
                $stmt = $conn->prepare("UPDATE Contato SET telefone = ? WHERE id = ?");
                $stmt->bind_param("si", $contato->getTelefone(), $contato->getID());
            } elseif ($contato->getEmail() != "") {
                $stmt = $conn->prepare("UPDATE Contato SET email = ? WHERE id = ?");
                $stmt->bind_param("si", $contato->getEmail(), $contato->getID());
            }
            if ($stmt->execute()) {
                if ($stmt->affected_rows == 0) {
                    $retorno = "erroUP";
                }
            } else {
                //$retorno = $stmt->error;
                $retorno = "erroSQL";
            }
            $stmt->close();
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
            $stmt = $conn->prepare("DELETE FROM Contato WHERE id = ?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                if ($stmt->affected_rows == 0) {
                    $retorno = "erroDEL";
                }
            } else {
                //$retorno = $stmt->error;
                $retorno = "erroSQL";
            }
            $stmt->close();
            $conn->close();
        } else {
            $retorno = "erroCONN";
        }
        
        return $retorno;
    }
}
