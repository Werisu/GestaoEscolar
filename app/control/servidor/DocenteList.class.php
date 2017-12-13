<?php

/**
 * A classe DocenteList.class.php lista os docentes cadastrados no sistema
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Nascimento Rocha
 * @version 1.0
 */
class DocenteList extends \Adianti\Base\TStandardList {
    
    protected $form;
    protected $datagrid;
    protected $pageNavigation;
    protected $formgrid;
    protected $deleteButtom;
    protected $transformCallback;
    
    public function __construct() {
        parent::__construct();
        
        parent::setDatabase('gestao_escolar');
        parent::setActiveRecord('Docente');
        parent::setDefaultOrder('nome', 'asc');
        parent::addFilterField('registro', '=', 'registro');
        parent::addFilterField('nome', 'like', 'nome');
        
        //Criando o formulario de busca
        $this->form = new \Adianti\Wrapper\BootstrapFormBuilder('form_busca_docente');
        $this->form->setFormTitle('Docentes');
        
        // criando os campos do formulario
        $id = new Adianti\Widget\Form\TEntry('registro');
        $nome = new Adianti\Widget\Form\TEntry('nome');
        $output_type  = new TRadioGroup('output_type');

        $options = array('html' => 'HTML', 'pdf' => 'PDF', 'rtf' => 'RTF');
        $output_type->addItems($options);
        $output_type->setValue('pdf');
        $output_type->setLayout('horizontal');
        
        // adicionando os campos
        $this->form->addFields([new \Adianti\Widget\Form\TLabel('Registro')], [$id]);
        $this->form->addFields([new \Adianti\Widget\Form\TLabel('Nome')], [$nome]);
        $this->form->addFields( [ new Adianti\Widget\Form\TLabel('Output') ],[$output_type] );
        
        $this->form->setData(Adianti\Registry\TSession::getValue('form_busca_sala'));
        
        // Ações
        $this->form->addAction(_t('Find'), new TAction(array($this, 'onSearch')), 'fa:search');
        $this->form->addAction(_t('New'),  new TAction(array('DocenteForm', 'onEdit')), 'bs:plus-sign green');
        
        // creates a DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        
        // creates the datagrid columns
        $column_id = new TDataGridColumn('registro', 'Registro', 'center', 50);
        $column_nome = new TDataGridColumn('nome', 'Nome', 'left');
        $column_formacao = new TDataGridColumn('formacao', 'Formação', 'left');
        $column_email = new TDataGridColumn('email', 'Email', 'left');
        
        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_nome);
        $this->datagrid->addColumn($column_email);
        $this->datagrid->addColumn($column_formacao);
        
        // creates the datagrid column actions
        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'registro');
        $column_id->setAction($order_id);
        
        $order_numero = new TAction(array($this, 'onReload'));
        $order_numero->setParameter('order', 'nome');
        $column_nome->setAction($order_numero);
        
        $order_email = new TAction(array($this, 'onReload'));
        $order_email->setParameter('order', 'nome');
        $column_email->setAction($order_email);
        
        $order_formacao = new TAction(array($this, 'onReload'));
        $order_formacao->setParameter('order', 'nome');
        $column_formacao->setAction($order_formacao);
        
        // create EDIT action
        $action_edit = new TDataGridAction(array('DocenteForm', 'onEdit'));
        $action_edit->setButtonClass('btn btn-default');
        $action_edit->setLabel(_t('Edit'));
        $action_edit->setImage('fa:pencil-square-o blue fa-lg');
        $action_edit->setField('registro');
        $this->datagrid->addAction($action_edit);
        
        // create DELETE action
        $action_del = new TDataGridAction(array($this, 'onDelete'));
        $action_del->setButtonClass('btn btn-default');
        $action_del->setLabel(_t('Delete'));
        $action_del->setImage('fa:trash-o red fa-lg');
        $action_del->setField('registro');
        $this->datagrid->addAction($action_del);
        
        $this->form->addAction( 'Generate', new TAction(array($this, 'onGenerate')), 'fa:download blue');
                
        // create the datagrid model
        $this->datagrid->createModel();
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 90%';
        #$container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        $container->add(TPanelGroup::pack('', $this->datagrid));
        $container->add($this->pageNavigation);
        
        parent::add($container);
        
    }
    
    function onGenerate()
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('gestao_escolar');
            
            // get the form data into an active record Customer
            $object = $this->form->getData();
            
            $repository = new TRepository('Docente');
            $criteria   = new TCriteria;
            if ($object->registro)
            {
                $criteria->add(new TFilter('registro', 'like', "%{$object->registro}%"));
            }
            
            if ($object->nome)
            {
                $criteria->add(new TFilter('nome', '=', "{$object->nome}"));
            }
           
            $customers = $repository->load($criteria);
            $format  = $object->output_type;
            
            if ($customers)
            {
                $widths = array(40, 150, 80, 120, 80);
                
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
                    $tr->addCell('Docente', 'center', 'header', 5);
                    
                    // add titles row
                    $tr->addRow();
                    $tr->addCell('Registro',      'left', 'title');
                    $tr->addCell('Nome',      'left', 'title');
                    $tr->addCell('Category',  'left', 'title');
                    $tr->addCell('Email',     'left', 'title');
                    $tr->addCell('Birthdate', 'left', 'title');
                    
                    // controls the background filling
                    $colour= FALSE;
                    
                    // data rows
                    foreach ($customers as $customer)
                    {
                        $style = $colour ? 'datap' : 'datai';
                        $tr->addRow();
                        $tr->addCell($customer->registro,                 'left', $style);
                        $tr->addCell($customer->nome,               'left', $style);
                        $tr->addCell($customer->formacao    ,  'left', $style);
                        $tr->addCell($customer->email,              'left', $style);
                        $tr->addCell($customer->birthdate,          'left', $style);
                        
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
