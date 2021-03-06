<?php

/**
 * A classe Turma.class.php é uma classes de modelo da aplicação do controle de Turmas.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha <wellysson35@gmail.com>
 * @version 1.0
 */
class Turma extends \Adianti\Database\TRecord {
    //put your code here
    const TABLENAME = 'turma';
    const PRIMARYKEY = 'idturma';
    const IDPOLICY = 'serial';
    
    public function __construct($id = null) {
        parent::__construct($id);
        
        parent::addAttribute('idturma');
        parent::addAttribute('turno');
        parent::addAttribute('sala_idsala');
    }
    
}
