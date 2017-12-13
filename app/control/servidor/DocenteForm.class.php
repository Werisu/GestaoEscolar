<?php

/**
 * DocenteForm.class.php
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class DocenteForm extends \Adianti\Control\TPage {
    
    protected $formulario;
    
    public function __construct() {
        parent::__construct();
        
        $this->formulario = new Adianti\Wrapper\BootstrapFormBuilder('form_docente');
        $this->formulario->setFormTitle('Cadastro de Docentes');
        
        $label1 = new TLabel('Pessoal', '#333', 12, 'bi');
        $label1->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $label2 = new TLabel('Endereço e Contato', '#333', 12, 'bi');
        $label2->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        
        $this->formulario->appendPage('Page 1');
        $this->formulario->addContent( [$label1] );
        
        $id = new Adianti\Widget\Form\TEntry('registro');
        $id->setSize('30%');
        $nome = new Adianti\Widget\Form\TEntry('nome');
        $nome->setSize('60%');
        $cpf = new Adianti\Widget\Form\TEntry('cpf');
        $cpf->setSize('30%');
        $rg = new Adianti\Widget\Form\TEntry('rg');
        $rg->setSize('30%');
        $logad = new Adianti\Widget\Form\TEntry('logadouro');
        $logad->setSize('60%');
        $bairro = new Adianti\Widget\Form\TEntry('bairro');
        $bairro->setSize('30%');
        $email = new Adianti\Widget\Form\TEntry('email');
        $sexo = new Adianti\Widget\Form\TCombo('sexo');
        $sexo->setSize('30%');
        $estato_civil = new Adianti\Widget\Form\TEntry('estato_civil');
        $estato_civil->setSize('30%');
        $formacao = new Adianti\Widget\Form\TEntry('formacao');
        $formacao->setSize('30%');
        
        //componetes
        $file      = new Adianti\Widget\Form\TFile('file');
        $multifile = new Adianti\Widget\Form\TMultiFile('multifile');
        
        $combo_items = array();
        $combo_items['m'] ='Masculino';
        $combo_items['f'] ='Feminino';
        
        $sexo->addItems($combo_items);
        
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('Registro') ],[$id]);
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('Nome Completo') ],[$nome]);
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('Estato Civil') ],[$estato_civil]);
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('Formação') ],[$formacao]);
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('Sexo') ],[$sexo]);
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('CPF') ],[$cpf]);
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('RG') ],[$rg]);
        
        $this->formulario->addContent( [$label2] );
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('Logadouro') ],[$logad]);
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('Bairro') ],[$bairro]);
        $this->formulario->addFields([ new Adianti\Widget\Form\TLabel('Email') ],[$email]);
        
        //Componetes Upload de Imagens
        $this->formulario->appendPage('File upload components');
        $this->formulario->addContent( [new TFormSeparator('File components')] );
        $this->formulario->addFields( [ new TLabel('TFile') ],      [ $file ] );
        $this->formulario->addFields( [ new TLabel('TMultiFile') ], [ $multifile ] );
        
        //Ações
        $this->formulario->addAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:floppy-o');
        $this->formulario->addAction(_t('Back to the listing'), new TAction(array('DocenteList','onReload')), 'fa:table blue');
        $this->formulario->addAction(_t('New'),  new TAction(array($this, 'onClear')), 'fa:eraser red');
        $this->formulario->addAction(_t('Delete'),  new TAction(array($this, 'onDelete')), 'fa:trash-o red fa-lg');
        
        $container = new \Adianti\Widget\Container\TVBox();
        $container->style = 'width: 100%';
        $container->add($this->formulario);
        $this->add($container);
        
    }
    
    public function onSave($param) {
        try{
            $this->formulario->validate();
            \Adianti\Database\TTransaction::open('gestao_escolar');
            $data = $this->formulario->getData();
            $sala = new Docente();
            $sala->fromArray((array) $data);
            $sala->store();
            \Adianti\Database\TTransaction::close();
            new Adianti\Widget\Dialog\TMessage('info', 'Docente Registrado');
            $this->formulario->setData($sala);
        } catch (Exception $ex) {
            new Adianti\Widget\Dialog\TMessage('error', $ex->getMessage());
            $this->formulario->setData( $this->formulario->getData() ); //error
            \Adianti\Database\TTransaction::rollback();
        }
    }
    
    public function onEdit($param){
        try{
            if(array_key_exists('registro', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $status = new Docente($param['registro']);
            TTransaction::close();
            $this->formulario->setData($status);
            }else{
                $this->onClear();
            }
        } catch (Exception $ex) {
            new TMessage('error', $ex->getMessage());
            $this->formulario->setData( $this->formulario->getData() ); //error
            TTransaction::rollback();
        }
    }
    
    public function onClear($param){
        
    }
    
    public function onDelete($param) {
        try{
            if(array_key_exists('registro', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $status = new Docente($param['registro']);
            $status->delete();
            TTransaction::close();
            $this->formulario->setData($status);
            }else{
                $this->onClear();
            }
        } catch (Exception $ex) {
            new TMessage('error', $ex->getMessage());
            $this->formulario->setData( $this->formulario->getData() ); //error
            TTransaction::rollback();
        }
    }
    
}
