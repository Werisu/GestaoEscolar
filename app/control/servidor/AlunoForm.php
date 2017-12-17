<?php

/**
 * A classe AlunoForm cadastrar aluno.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class AlunoForm extends Adianti\Control\TPage {
    
    /** @var string pega os dados do formulário **/
    protected $form;
    
    public function __construct() {
        parent::__construct();
        
        $this->form = new \Adianti\Wrapper\BootstrapFormBuilder('form_aluno');
        $this->form->setFormTitle('Cadastro de Alunos');
        
        $label1 = new TLabel('Pessoal', '#333', 12, 'bi');
        $label1->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        $label2 = new TLabel('Endereço e Contato', '#333', 12, 'bi');
        $label2->style='text-align:left;border-bottom:1px solid #c0c0c0;width:100%';
        
        $this->form->addContent([$label1]);
        
        //Criando campos
        $matricula = new \Adianti\Widget\Form\TEntry('matricula');
        $nome = new \Adianti\Widget\Form\TEntry('nome');
        $cpf = new \Adianti\Widget\Form\TEntry('cpf');
        $rg = new \Adianti\Widget\Form\TEntry('rg');
        $email = new \Adianti\Widget\Form\TEntry('email');
        $data_nasc = new \Adianti\Widget\Form\TEntry('data_nasc');
        $sexo = new \Adianti\Widget\Form\TCombo('sexo');
        $logadouro = new \Adianti\Widget\Form\TEntry('logadouro');
        $bairro = new \Adianti\Widget\Form\TEntry('bairro');
        $cep = new \Adianti\Widget\Form\TEntry('cep');
        $t_id = new \Adianti\Widget\Form\TCombo('turma_idturma');
        
        // Array do sexo
        $combo_items = array();
        $combo_items['Masculino'] ='Masculino';
        $combo_items['Feminino'] ='Feminino';
        $sexo->addItems($combo_items);
        
        // Array ForeKey
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "g_e";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT idturma FROM g_e.turma;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $combo_items = array();
            while($row = $result->fetch_assoc()) {
                #echo "id: " . $row["idSala"]. "<br>";
                $combo_items[$row["idturma"]] =$row["idturma"];
            }
        } else {
            echo "0 results";
        }
        $conn->close();
                
        $t_id->addItems($combo_items);
        
        $this->form->addFields([ new Adianti\Widget\Form\TLabel('Matricula') ],[$matricula]);
        $this->form->addFields([ new Adianti\Widget\Form\TLabel('Nome Completo') ],[$nome]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Data de Nascimento')],[$data_nasc]);
        $this->form->addFields([ new Adianti\Widget\Form\TLabel('CPF') ],[$cpf]);
        $this->form->addFields([ new Adianti\Widget\Form\TLabel('RG') ],[$rg]);
        $this->form->addFields([ new Adianti\Widget\Form\TLabel('Sexo') ],[$sexo]);
        
        $this->form->addContent([$label2]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Endereço')],[$logadouro]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Bairro')],[$bairro]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('CEP')],[$cep]);
        $this->form->addFields([ new Adianti\Widget\Form\TLabel('Email') ],[$email]);
        
        $this->form->addContent(['Turma']);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Turma')],[$t_id]);
        
        //Ações
        $this->form->addAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:floppy-o');
        #$this->formulario->addAction(_t('Back to the listing'), new TAction(array('DocenteList','onReload')), 'fa:table blue');
        $this->form->addAction(_t('New'),  new TAction(array($this, 'onClear')), 'fa:eraser red');
        $this->form->addAction(_t('Delete'),  new TAction(array($this, 'onDelete')), 'fa:trash-o red fa-lg');
        
        // TV
        $container = new \Adianti\Widget\Container\TVBox();
        $container->style = 'width: 100%';
        $container->add($this->form);
        $this->add($container);
        
    }
    
    public function onSave($param) {
        try{
            $this->form->validate();
            \Adianti\Database\TTransaction::open('gestao_escolar');
            $data = $this->form->getData();
            $sala = new Aluno();
            $sala->fromArray((array) $data);
            $sala->store();
            \Adianti\Database\TTransaction::close();
            new Adianti\Widget\Dialog\TMessage('info', 'Aluno Registrado');
            $this->form->setData($sala);
        } catch (Exception $ex) {
            new Adianti\Widget\Dialog\TMessage('error', $ex->getMessage());
            $this->form->setData( $this->form->getData() ); //error
            \Adianti\Database\TTransaction::rollback();
        }
    }
    
    public function onEdit($param){
        try{
            if(array_key_exists('matricula', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $status = new Docente($param['matricula']);
            TTransaction::close();
            $this->form->setData($status);
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
            if(array_key_exists('matricula', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $status = new Docente($param['matricula']);
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
