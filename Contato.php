<?php

/**
 *
 * @author iagocolodetti
 */

class Contato {
    
    private $id,
            $nome,
            $telefone,
            $email;
    
    public function __construct($id, $nome, $telefone, $email) {
        $this->setID($id);
        $this->setNome($nome);
        $this->setTelefone($telefone);
        $this->setEmail($email);
    }
    
    public function getID() {
        return $this->id;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function setID($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

}
