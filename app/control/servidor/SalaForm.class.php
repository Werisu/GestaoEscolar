<?php

/**
 * A classe Pessoa.class.php vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, John Doe
 * @version 1.0
 */
class SalaForm extends \Adianti\Control\TPage {
    //put your code here
    
    protected $form;
    public function __construct() {
        parent::__construct();
        
        $this->form = new \Adianti\Wrapper\BootstrapFormBuilder('form_sala');
        $this->form->setFormTitle('Cadastro de Salas');
        
        $id = new Adianti\Widget\Form\TEntry('idsala');
        $id->setEditable(FALSE);
        $id->setSize('30%');
        
        $numero = new Adianti\Widget\Form\TEntry('numero');
        $numero->addValidation('numero', new Adianti\Validator\TRequiredValidator());
        
        $this->form->addFields([new \Adianti\Widget\Form\TLabel('ID')],[$id]);
        $this->form->addFields([new \Adianti\Widget\Form\TLabel('Numero da Sala')],[$numero]);
        
        //Ações
        $this->form->addAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:floppy-o');
        $this->form->addAction(_t('Back to the listing'), new TAction(array('SalaList','onReload')), 'fa:table blue');
        $this->form->addAction(_t('New'),  new TAction(array($this, 'onClear')), 'fa:eraser red');
        $this->form->addAction(_t('Delete'),  new TAction(array($this, 'onDelete')), 'fa:trash-o red fa-lg');
        
        $container = new \Adianti\Widget\Container\TVBox();
        $container->style = 'width: 90%';
        $container->add($this->form);
        $this->add($container);
    }
    
    public function onSave($param) {
        try{
            $this->form->validate();
            \Adianti\Database\TTransaction::open('gestao_escolar');
            $data = $this->form->getData();
            $sala = new Sala();
            $sala->fromArray((array) $data);
            $sala->store();
            \Adianti\Database\TTransaction::close();
            new Adianti\Widget\Dialog\TMessage('info', 'Sala Cadastrada');
            $this->form->setData($sala);
        } catch (Exception $ex) {
            new Adianti\Widget\Dialog\TMessage('error', $ex->getMessage());
            $this->form->setData( $this->form->getData() ); //error
            \Adianti\Database\TTransaction::rollback();
        }
    }
    
    public function onEdit($param){
        try{
            if(array_key_exists('idsala', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $status = new Sala($param['idsala']);
            TTransaction::close();
            $this->form->setData($status);
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
            if(array_key_exists('idsala', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $status = new Sala($param['idsala']);
            $status->delete();
            TTransaction::close();
            $this->form->setData($status);
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
