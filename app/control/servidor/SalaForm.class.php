<?php

/**
 * A classe SalaForm.class.php é uma classe controladora de aplicação responsável pela manipulação do formulário de inserção de informações no banco de dados
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class SalaForm extends \Adianti\Control\TPage {
    //put your code here
    
    /** @var string para criar o formulário */
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
    
    /**
     * A função onSave captura e grava as informações do formulário no banco de dados
     * 
     * @param int $param
     */
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
    
    /**
     * A função onEdite edit dados já gravados no banco de dados
     * 
     * @param int $param
     */
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
    
    /**
     * A função onClear reseta o formulário para inserir outra informação
     * 
     * @param type $param
     */
    public function onClear($param){
        
    }
    
    /**
     * A função onDelete deleta uma tupla específica do banco de dados
     * 
     * @param int $param
     */
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
