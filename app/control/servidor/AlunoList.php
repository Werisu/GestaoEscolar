<?php

/**
 * A classe AlunoList.class.php éuma classe controladora da aplicação Alunos com a Função de listar os alunos
 * cadastrados no banco de dados.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha <wellysson35@gmail.com>
 * @version 1.0
 */
class AlunoList extends Adianti\Base\TStandardList {
    
    /** @var string Cria o formulário para pesquisa */
    protected $form;
    /** @var string cria a tabela com informações do banco de dados */
    protected $datagrid;
    /** @var string cria a navegação da página */
    protected $pageNavigation;
    /** @var string Description */
    protected $formgrid;
    protected $deleteButtom;
    protected $transformCallback;
    
    public function __construct() {
        parent::__construct();
        
        parent::setDatabase('gestao_escolar');
        parent::setActiveRecord('Aluno');
        parent::setDefaultOrder('nome', 'asc');
        parent::addFilterField('matricula', '=', 'mastricula');
        parent::addFilterField('nome', 'like', 'nome');
        parent::addFilterField('turma_idturma', 'like', 'turma_idturma');
        
        //Criando o formulario de busca
        $this->form = new Adianti\Wrapper\BootstrapFormBuilder('form_busca_aluno');
        $this->form->setFormTitle('Lista de Alunos');
        
        // Criando os campos do formulario
        $matricula = new \Adianti\Widget\Form\TEntry('matricula');
        $nome = new \Adianti\Widget\Form\TEntry('nome');
        $turma = new \Adianti\Widget\Form\TCombo('turma_idturma');
        $output_type = new Adianti\Widget\Form\TRadioGroup('output_type');
        
        $options = array('html' => 'HTML', 'pdf' => 'PDF', 'rtf' => 'RTF');
        $output_type->addItems($options);
        $output_type->setValue('pdf');
        $output_type->setLayout('vertical');
        
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

        $sql = "SELECT turma_idturma FROM g_e.aluno;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $combo_items = array();
            while($row = $result->fetch_assoc()) {
                #echo "id: " . $row["idSala"]. "<br>";
                $combo_items[$row["turma_idturma"]] =$row["turma_idturma"];
            }
        } else {
            echo "0 results";
        }
        $conn->close();
                
        $turma->addItems($combo_items);
        
        // Adicionando os campos
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Matricula')], [$matricula]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Nome')], [$nome]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Turma')], [$turma]);
        $this->form->addFields([new Adianti\Widget\Form\TLabel('Output')], [$output_type]);
        
        $this->form->setData(Adianti\Registry\TSession::getValue('form_busca_aluno'));
        
        // Ações
        $this->form->addAction(_t('Find'), new Adianti\Control\TAction(array($this,'onSearch')), 'fa:search');
        $this->form->addAction(_t('New'), new Adianti\Control\TAction(array('AlunoForm', 'onEdit')), 'bs:plus-sign green');
        
        // criando uma Tabela
        $this->datagrid = new Adianti\Wrapper\BootstrapDatagridWrapper(new Adianti\Widget\Datagrid\TDataGrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        
        // criando as colunas da tabela
        $column_matricula = new Adianti\Widget\Datagrid\TDataGridColumn('matricula', 'Matricula', 'center');
        $column_nome = new \Adianti\Widget\Datagrid\TDataGridColumn('nome', 'Nome', 'left');
        $column_cpf = new \Adianti\Widget\Datagrid\TDataGridColumn('cpf', 'CPF', 'left');
        $column_email = new \Adianti\Widget\Datagrid\TDataGridColumn('email', 'Email', 'left');
        $column_turma = new \Adianti\Widget\Datagrid\TDataGridColumn('turma_idturma', 'Turma', 'left');
        
        // Adicionando as colunas na tabela
        $this->datagrid->addColumn($column_matricula);
        $this->datagrid->addColumn($column_nome);
        $this->datagrid->addColumn($column_cpf);
        $this->datagrid->addColumn($column_email);
        $this->datagrid->addColumn($column_turma);
        
        // creates the datagrid column actions
        $order_matricula = new Adianti\Control\TAction(array($this, 'onReload'));
        $order_matricula->setParameter('order', 'matricula');
        $column_matricula->setAction($order_matricula);
        
        $order_nome = new Adianti\Control\TAction(array($this, 'onReload'));
        $order_nome->setParameter('order', 'nome');
        $column_nome->setAction($order_nome);
        
        $order_cpf = new Adianti\Control\TAction(array($this, 'onReload'));
        $order_cpf->setParameter('order', 'cpf');
        $column_cpf->setAction($order_cpf);
        
        $order_email = new TAction(array($this, 'onReload'));
        $order_email->setParameter('order', 'nome');
        $column_email->setAction($order_email);
        
        $order_turma = new \Adianti\Control\TAction(array($this, 'onReload'));
        $order_turma->setParameter('order', 'turma_idturma');
        $column_turma->setAction($order_turma);
        
        // create EDIT action
        $action_edit = new TDataGridAction(array('AlunoForm', 'onEdit'));
        $action_edit->setButtonClass('btn btn-default');
        $action_edit->setLabel(_t('Edit'));
        $action_edit->setImage('fa:pencil-square-o blue fa-lg');
        $action_edit->setField('matricula');
        $this->datagrid->addAction($action_edit);
        
        // create DELETE action
        $action_del = new TDataGridAction(array($this, 'onDelete'));
        $action_del->setButtonClass('btn btn-default');
        $action_del->setLabel(_t('Delete'));
        $action_del->setImage('fa:trash-o red fa-lg');
        $action_del->setField('matricula');
        $this->datagrid->addAction($action_del);
        
        $this->form->addAction( 'Gerar', new TAction(array($this, 'onGenerate')), 'fa:download blue');
        
        //create the datagrid model
        $this->datagrid->createModel();
        
        // create the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 90%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        $container->add(TPanelGroup::pack('', $this->datagrid));
        $container->add($this->pageNavigation);
        
        parent::add($container);
        
    }
    
    function onGenerate(){
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('gestao_escolar');
            
            // get the form data into an active record Customer
            $object = $this->form->getData();
            
            $repository = new TRepository('Aluno');
            $criteria   = new TCriteria;
            if ($object->matricula)
            {
                $criteria->add(new TFilter('matricula', 'like', "%{$object->matricula}%"));
            }
            
            if ($object->nome)
            {
                $criteria->add(new TFilter('nome', '=', "{$object->nome}"));
            }
           
            $customers = $repository->load($criteria);
            $format  = $object->output_type;
            
            if ($customers)
            {
                $widths = array(80, 150, 180, 120, 80);
                
                switch ($format)
                {
                    case 'html':
                        $tr = new TTableWriterHTML($widths);
                        break;
                    case 'pdf':
                        $tr = new TTableWriterPDF($widths);
                        break;
                    case 'rtf':
                        if (!class_exists('PHPRtfLite_Autoloader'))
                        {
                            PHPRtfLite::registerAutoloader();
                        }
                        $tr = new TTableWriterRTF($widths);
                        break;
                }
                
                if (!empty($tr))
                {
                    // create the document styles
                    $tr->addStyle('title', 'Arial', '10', 'BI',  '#ffffff', '#407B49');
                    $tr->addStyle('datap', 'Arial', '10', '',    '#000000', '#869FBB');
                    $tr->addStyle('datai', 'Arial', '10', '',    '#000000', '#ffffff');
                    $tr->addStyle('header', 'Times', '16', 'BI', '#ff0000', '#FFF1B2');
                    $tr->addStyle('footer', 'Times', '12', 'BI', '#2B2B2B', '#B5FFB4');
                    
                    // add a header row
                    $tr->addRow();
                    $tr->addCell('Aluno', 'center', 'header', 5);
                    
                    // add titles row
                    $tr->addRow();
                    $tr->addCell('Matricula',      'left', 'title');
                    $tr->addCell('Nome',      'left', 'title');
                    $tr->addCell('CPF',  'left', 'title');
                    $tr->addCell('Email',     'left', 'title');
                    $tr->addCell('Turma', 'left', 'title');
                    
                    // controls the background filling
                    $colour= FALSE;
                    
                    // data rows
                    foreach ($customers as $customer)
                    {
                        $style = $colour ? 'datap' : 'datai';
                        $tr->addRow();
                        $tr->addCell($customer->matricula,                 'left', $style);
                        $tr->addCell($customer->nome,               'left', $style);
                        $tr->addCell($customer->cpf    ,  'left', $style);
                        $tr->addCell($customer->email,              'left', $style);
                        $tr->addCell($customer->turma_idturma,          'left', $style);
                        
                        $colour = !$colour;
                    }
                    
                    // footer row
                    $tr->addRow();
                    $tr->addCell(date('Y-m-d h:i:s'), 'center', 'footer', 5);
                    // stores the file
                    if (!file_exists("app/output/tabular.{$format}") OR is_writable("app/output/tabular.{$format}"))
                    {
                        $tr->save("app/output/tabular.{$format}");
                    }
                    else
                    {
                        throw new Exception(_t('Permission denied') . ': ' . "app/output/tabular.{$format}");
                    }
                    
                    parent::openFile("app/output/tabular.{$format}");
                    
                    // shows the success message
                    new TMessage('info', 'Report generated. Please, enable popups in the browser.');
                }
            }
            else
            {
                new TMessage('error', 'No records found');
            }
    
            // fill the form with the active record data
            $this->form->setData($object);
            
            // close the transaction
            TTransaction::close();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
}
