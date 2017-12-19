<?php

/**
 * A classe Sala.class.php é uma classes de modelo da aplicação do controle de Salas.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha <wellysson35@gmail.com>
 * @version 1.0
 */
class Sala extends \Adianti\Database\TRecord {
    //put your code here
    
    const TABLENAME = 'sala';
    const PRIMARYKEY = 'idsala';
    const IDPOLICY = 'max';
    
    public function __construct($idSala = NULL) {
        parent::__construct($idSala);
        
        parent::addAttribute('idsala');
        parent::addAttribute('numero');
    }
}
