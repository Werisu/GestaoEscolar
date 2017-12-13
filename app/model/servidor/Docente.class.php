<?php

/**
 * Docente.class.php
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class Docente extends Adianti\Database\TRecord {
    
    const TABLENAME = 'docente';
    const PRIMARYKEY = 'registro';
    const IDPOLICY = 'max';
    
    public function __construct($id = NULL, $callObjectLoad = TRUE) {
        parent::__construct($id, $callObjectLoad);
        
        parent::addAttribute('registro');
        parent::addAttribute('nome');
        parent::addAttribute('cpf');
        parent::addAttribute('rg');
        parent::addAttribute('logadouro');
        parent::addAttribute('bairro');
        parent::addAttribute('email');
        parent::addAttribute('sexo');
        parent::addAttribute('estato_civil');
        parent::addAttribute('formacao');
        parent::addAttribute('file');
        
    }
    
}
