<?php

/**
 * A classe DisciplinaForm vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class DisciplinaForm extends \Adianti\Control\TPage {
    //put your code here
    
    protected $form;
    public function __construct() {
        parent::__construct();
        
        $this->form = new Adianti\Wrapper\BootstrapFormBuilder();
        $this->form->setFormTitle('Cadastro de Disciplinas');
        
        $id = new Adianti\Widget\Form\TEntry('iddisciplina');
        $id->setEditable(FALSE);
        $id->setSize('5%');
        
        $titulo = new Adianti\Widget\Form\TEntry('titulo');
        $docente = new Adianti\Widget\Form\TCombo('docente_iddocente');
        
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

        $sql = "SELECT * FROM docente";
        $result = $conn->query($sql);

        if ($result->num_rows >= 0) {
            // output data of each row
            $combo_items = array();
            while($row = $result->fetch_assoc()) {
                #echo "id: " . $row["idSala"]. "<br>";
                $combo_items[$row["iddocente"]] = $row["iddocente"];
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        
        
        $docente->addItems($combo_items);
        
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Id')],[$id]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Titulo')],[$titulo]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Docente')],[$docente]);
        
        //Ações
        $this->form->addAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:floppy-o');
        $this->form->addAction(_t('Back to the listing'), new TAction(array('DisciplinaList','onReload')), 'fa:table blue');
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
            $disciplina = new Disciplina();
            $disciplina->fromArray((array) $data);
            $disciplina->store();
            \Adianti\Database\TTransaction::close();
            new Adianti\Widget\Dialog\TMessage('info', 'Disciplina Cadastrada');
            $this->form->setData($disciplina);
        } catch (Exception $ex) {
            new Adianti\Widget\Dialog\TMessage('error', $ex->getMessage());
            $this->form->setData( $this->form->getData() ); //error
            \Adianti\Database\TTransaction::rollback();
        }
    }
    
    public function onEdit($param){
        try{
            if(array_key_exists('iddisciplina', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $status = new Disciplina($param['iddisciplina']);
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
            if(array_key_exists('iddisciplina', $param)){
                
            
            TTransaction::open('gestao_escolar');
            $status = new Disciplina($param['iddisciplina']);
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
