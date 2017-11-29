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
        
        $this->form = new BootstrapFormBuilder('form_turma');
        $this->form->setFormTitle('Cadastro de Turmas');
        
        $id = new \Adianti\Widget\Form\TEntry('id');
        $turno = new \Adianti\Widget\Form\TEntry('turno');
        
        $this->form->addFields( [new TLabel('ID da turma')],[$id]);
        $this->form->addFields( [new TLabel('Turno')],[$turno] );
        #$this->form->addQuickField('ID da turma', $id);
        #$this->form->addQuickField('turno', $turno);
        
        
        // Ações do adiante
        $this->form->addAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:floppy-o');
        #$salvar = new Adianti\Control\TAction( array($this, 'onSave'));
        #$this->form->addQuickAction('Salvar', $salvar, 'ico_save.png');
        
        $this->form->addAction(_t('Back to the listing'), new TAction(array('TurmaList','onReload')), 'fa:table blue');
        #$listar = new Adianti\Control\TAction(array('TurmaList','onReload'));
        #$this->form->addQuickAction('Listar', $listar, 'ico_datagrid.png');
        
        $container = new TVBox();
        $container->style = 'width: 90%';
        $container->add($this->form);
        $this->add($container);
        
    }
    
    public function onSave() {
        
         try{
            #$this->form->validate();
            TTransaction::open('gestao_escolar');
            $data = $this->form->getData();
            $turno = new Turma();
            $turno->fromArray( (array) $data);
            $turno->store();
            TTransaction::close();
            new TMessage('info', 'Salvo com Sucesso');
            $this->form->setData($turno);
        } catch (Exception $ex) {
            new TMessage('error', $ex->getMessage());
            $this->form->setData( $this->form->getData() ); //error
            TTransaction::rollback();
        }
        
    }
    
    public function onEdit($param) {
        try{
            if(array_key_exists('id', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $turno = new Turma($param['id']);
            TTransaction::close();
            $this->form->setData($turno);
            }else{
                $this->onClear();
            }
        } catch (Exception $ex) {
            new TMessage('error', $ex->getMessage());
            $this->form->setData( $this->form->getData() ); //error
            TTransaction::rollback();
        }
    }
    
     public function onClear($param){
        
    }
    
    public function onDelete($param) {
        try{
            if(array_key_exists('id', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $turno = new OsStatus($param['id']);
            $turno->delete();
            TTransaction::close();
            $this->form->setData($turno);
            }else{
                $this->onClear();
            }
        } catch (Exception $ex) {
            new TMessage('error', $ex->getMessage());
            $this->form->setData( $this->form->getData() ); //error
            TTransaction::rollback();
        }
    }
    
}