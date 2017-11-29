<?php

/**
 * A classe Pessoa.class.php vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, John Doe
 * @version 1.0
 */
class Sala extends \Adianti\Database\TRecord {
    //put your code here
    
    const TABLENAME = 'sala';
    const PRIMARYKEY = 'idSala';
    const IDPOLICY = 'max';
    
    public function __construct($idSala = NULL) {
        parent::__construct($idSala);
        
        parent::addAttribute('idSala');
        parent::addAttribute('numero');
    }
}
