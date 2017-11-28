<?php

/**
 * A classe TurmaForm.class.php vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, John Doe
 * @version 1.0
 */
class TurmaForm extends \Adianti\Control\TPage {
    //put your code here
    
    private $form;


    public function __construct() {
        parent::__construct();
        
        $this->form = new Adianti\Widget\Wrapper\TQuickForm('form_turma');
        $this->form->setFormTitle('Cadastro de Turmas');
        $this->form->class = 'tform';
        
        $id = new \Adianti\Widget\Form\TEntry('id');
        $turno = new \Adianti\Widget\Form\TEntry('turno');
        
        $this->form->addQuickField('ID da turma', $id);
        $this->form->addQuickField('turno', $turno);
        
        
        // Ações do adiante
        $salvar = new Adianti\Control\TAction( array($this, 'onSave'));
        $this->form->addQuickAction('Salvar', $salvar, 'ico_save.png');
        
        $listar = new Adianti\Control\TAction(array('TurmaList','onReload'));
        $this->form->addQuickAction('Listar', $listar, 'ico_datagrid.png');
        
        parent::add($this->form);
        
    }
    
    public function onSave() {
        
        try {
            \Adianti\Database\TTransaction::open('gestao_escolar');
            
            $object = $this->form->getData('Turma');
            
            $object->store();
            
            $this->form->setData($object);
            
            new \Adianti\Widget\Dialog\TMessage('info', 'Turma Registrada!');
            
            \Adianti\Database\TTransaction::close();
        } catch (Exception $e) {
            new \Adianti\Widget\Dialog\TMessage('error', $e->getMessage());
            \Adianti\Database\TTransaction::rollback();
        }
        
    }
    
    public function onEdit($param) {
        try{
            \Adianti\Database\TTransaction::open('gestao_escolar');
            
            $key = $param['key'];
            
            $object = new Turma($key);
            
            $this->form->setData($object);
            
            \Adianti\Database\TTransaction::close();
        } catch (Exception $e) {
            new \Adianti\Widget\Dialog\TMessage('error', $e->getMessage());
            
        }
    }
    
}
