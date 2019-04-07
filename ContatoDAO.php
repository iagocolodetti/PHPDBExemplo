<?php

/**
 *
 * @author iagocolodetti
 */
interface ContatoDAO {
    
    public function adicionar($contato);
    
    public function buscarPorID($id);
    
    public function buscarPorNome($nome);
    
    public function buscarPorTelefone($telefone);
    
    public function buscarPorEmail($email);
    
    public function buscarTodos();
    
    public function alterar($contato);
    
    public function deletar($id);
}
