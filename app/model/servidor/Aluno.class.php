<?php

/**
 * A classe Aluno vai ser usada para implementar o AlunoForm e AlunoList
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class Aluno extends Adianti\Database\TRecord {
    //put your code here
    
    const TABLENAME = 'aluno';
    const PRIMARYKEY = 'matricula';
    const IDPOLICY = 'max';
    
    public function __construct($id = NULL, $callObjectLoad = TRUE) {
        parent::__construct($id, $callObjectLoad);
        
        parent::addAttribute('matricula');
        parent::addAttribute('nome');
        parent::addAttribute('cpf');
        parent::addAttribute('rg');
        parent::addAttribute('email');
        parent::addAttribute('logadouro');
        parent::addAttribute('bairro');
        parent::addAttribute('cep');
        parent::addAttribute('sexo');
        parent::addAttribute('data_nasc');
        parent::addAttribute('turma_idturma');
        
    }
    
}
