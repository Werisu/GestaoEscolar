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
    private $datagrid;
    public function __construct() {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder('form_turma');
        $this->form->setFormTitle('Cadastro de Turmas');
        
        $id = new \Adianti\Widget\Form\TEntry('id');
        $turno = new \Adianti\Widget\Form\TEntry('turno');
        $sala = new \Adianti\Widget\Form\TCombo('sala_idsala');
        $file      = new TFile('file');
        $multifile = new TMultiFile('multifile');
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestao_escolar";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT idSala FROM Sala";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $combo_items = array();
            while($row = $result->fetch_assoc()) {
                #echo "id: " . $row["idSala"]. "<br>";
                $combo_items[$row["idSala"]] =$row["idSala"];
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        
        
        $sala->addItems($combo_items);
        
        $this->form->appendPage('Dados');
        $this->form->addFields( [new TLabel('ID da turma')],[$id]);
        $this->form->addFields( [new TLabel('Turno')],[$turno] );
        $this->form->addFields( [new TLabel('Sala')],[$sala] );
        $this->form->appendPage('File upload components');
        $this->form->addContent( [new TFormSeparator('File components')] );
        $this->form->addFields( [ new TLabel('TFile') ],      [ $file ] );
        $this->form->addFields( [ new TLabel('TMultiFile') ], [ $multifile ] );
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
