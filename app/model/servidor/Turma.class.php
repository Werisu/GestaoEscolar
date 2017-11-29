<?php

/**
 * A classe Turma.class.php cadastra as turmas
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class Turma extends \Adianti\Database\TRecord {
    //put your code here
    const TABLENAME = 'turma';
    const PRIMARYKEY = 'id';
    const IDPOLICY = 'serial';
    
    public function __construct($id = null) {
        parent::__construct($id);
        
        parent::addAttribute('id');
        parent::addAttribute('turno');
        parent::addAttribute('sala_idsala');
    }
    
}
