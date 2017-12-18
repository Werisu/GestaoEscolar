<?php

/**
 * A classe Disciplina vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
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
