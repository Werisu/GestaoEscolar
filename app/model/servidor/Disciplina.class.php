<?php

/**
 * A classe Disciplina é uma classes de modelo da aplicação do controle de Disciplinas.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha <wellysson35@gmail.com>
 * @version 1.0
 */
class Disciplina extends Adianti\Database\TRecord {
    
    const TABLENAME = 'disciplina';
    const PRIMARYKEY = 'iddisciplina';
    const IDPOLICY = 'max';
    
    public function __construct($id = NULL, $callObjectLoad = TRUE) {
        parent::__construct($id, $callObjectLoad);
        
        parent::addAttribute('iddisciplina');
        parent::addAttribute('titulo');
        parent::addAttribute('docente_iddocente');
        
    }
    
}
