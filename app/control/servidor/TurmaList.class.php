<?php

/**
 * A classe TurmaList.class.php vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class TurmaList extends Adianti\Base\TStandardList{
    //put your code here
    
    #private $datagrid;
    #private $loaded;
    
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    protected $formgrid;
    protected $deleteButton;
    protected $transformCallback;
            
    function __construct() {
        parent::__construct();
        
        parent::setDatabase('gestao_escolar');            // defines the database
        parent::setActiveRecord('Turma');   // defines the active record
        parent::setDefaultOrder('idturma', 'asc');         // defines the default order
        parent::addFilterField('idturma', '=', 'idturma'); // filterField, operator, formField
        parent::addFilterField('turno', 'like', 'turno'); // filterField, operator, formField
        parent::addFilterField('sala_idsala', 'like', 'sala_idsala'); // filterField, operator, formField
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_busca_turmas');
        $this->form->setFormTitle('Turmas');
        
        // create the form fields
        $id = new TEntry('idturma');
        $turno = new TEntry('turno');
        $sala = new TEntry('sala_idsala');
        
        // add the fields
        $this->form->addFields( [new TLabel('Id')], [$id] );
        $this->form->addFields( [new TLabel('Turno')], [$turno] );
        $this->form->addFields( [new TLabel('Sala')], [$sala] );
        
        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue('form_busca_turmas') );
        
        // add the search form actions
        $this->form->addAction(_t('Find'), new TAction(array($this, 'onSearch')), 'fa:search');
        $this->form->addAction(_t('New'),  new TAction(array('TurmaForm', 'onEdit')), 'bs:plus-sign green');
        
        // creates a DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        
        // creates the datagrid columns
        $column_id = new TDataGridColumn('idturma', 'Id', 'center', 50);
        $column_turno = new TDataGridColumn('turno', 'Turno', 'left');
        $column_sala = new TDataGridColumn('sala_idsala', 'Sala', 'left');
        
        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_turno);
        $this->datagrid->addColumn($column_sala);
        
        // creates the datagrid column actions
        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'idturma');
        $column_id->setAction($order_id);
        
        $order_turno = new TAction(array($this, 'onReload'));
        $order_turno->setParameter('order', 'status');
        $column_turno->setAction($order_turno);
        
        // create EDIT action
        $action_edit = new TDataGridAction(array('TurmaForm', 'onEdit'));
        $action_edit->setButtonClass('btn btn-default');
        $action_edit->setLabel(_t('Edit'));
        $action_edit->setImage('fa:pencil-square-o blue fa-lg');
        $action_edit->setField('idturma');
        $this->datagrid->addAction($action_edit);
        
        // create DELETE action
        $action_del = new TDataGridAction(array($this, 'onDelete'));
        $action_del->setButtonClass('btn btn-default');
        $action_del->setLabel(_t('Delete'));
        $action_del->setImage('fa:trash-o red fa-lg');
        $action_del->setField('idturma');
        $this->datagrid->addAction($action_del);
        
        // create the datagrid model
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
        
        /*$this->datagrid = new Adianti\Widget\Wrapper\TQuickGrid;
        $this->datagrid->addQuickColumn('ID da Turma', 'id', 'right');
        $this->datagrid->addQuickColumn('Turno', 'turno', 'left');
        
        $edit = new \Adianti\Widget\Datagrid\TDataGridAction(array('TurmaForm','onEdit'));
        $this->datagrid->addQuickAction('Editar', $edit, 'id', 'ico_edit.png');
        $this->datagrid->createModel();*/
        
        #parent::add($this->datagrid);
    }
    /*
    public function onReload($param = null) {
        try {
            \Adianti\Database\TTransaction::open('gestao_escolar');
            
            $repository = new Adianti\Database\TRepository('Turma');
            $criteria = new \Adianti\Database\TCriteria();
            $objects = $repository->load($criteria);
            
            $this->datagrid->clear();
            
            if($objects):
                foreach ($objects as $object){
                    $this->datagrid->addItem($object);
                }
            endif;
            
            \Adianti\Database\TTransaction::close();
        } catch (Exception $e) {
            new \Adianti\Widget\Dialog\TMessage('eoor', $e->getMessage());
        }
        $this->loaded = TRUE;
    }
    
    public function show() {
        if(!$this->loaded):
            $this->onReload();
        endif;
        parent::show();
    }*/
}
