<?php

/**
 * A classe Docente.class.php é uma classes de modelo da aplicação do controle de Docentes.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha <wellysson35@gmail.com>
 * @version 1.0
 */
class Docente extends Adianti\Database\TRecord {
    
    const TABLENAME = 'docente';
    const PRIMARYKEY = 'iddocente';
    const IDPOLICY = 'max';
    
    public function __construct($id = NULL, $callObjectLoad = TRUE) {
        parent::__construct($id, $callObjectLoad);
        
        parent::addAttribute('iddocente');
        parent::addAttribute('nome');
        parent::addAttribute('cpf_docente');
        parent::addAttribute('rg');
        parent::addAttribute('logadouro');
        parent::addAttribute('bairro');
        parent::addAttribute('email');
        parent::addAttribute('sexo');
        parent::addAttribute('estado_civil');
        parent::addAttribute('formacao');
        parent::addAttribute('file');
        
    }
    
}
