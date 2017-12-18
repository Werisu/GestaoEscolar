<?php

/**
 * A classe DisciplinaList vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class DisciplinaList extends \Adianti\Base\TStandardList {
    //put your code here
    
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    protected $formgrid;
    protected $deleteButton;
    protected $transformCallback;
    
    public function __construct() {
        parent::__construct();
        
        parent::setDatabase('gestao_escolar');
        parent::setActiveRecord('Disciplina');
        parent::setDefaultOrder('iddisciplina', 'asc');
        parent::addFilterField('iddisciplina', '=', 'iddisciplina');
        parent::addFilterField('titulo', 'like', 'titulo');
        
        // criando o formulario
        $this->form = new \Adianti\Wrapper\BootstrapFormBuilder('form_busca_disciplina');
        $this->form->setFormTitle('Disciplinas');
        
        // criando os campos do formulario
        $id = new Adianti\Widget\Form\TEntry('iddisciplina');
        $titulo = new Adianti\Widget\Form\TEntry('titulo');
        
        // adicionando os campos
        $this->form->addFields([new \Adianti\Widget\Form\TLabel('Id')], [$id]);
        $this->form->addFields([new \Adianti\Widget\Form\TLabel('Titulo')], [$titulo]);
        
        $this->form->setData(Adianti\Registry\TSession::getValue('form_busca_disciplina'));
        
        //ações
        $this->form->addAction(_t('Find'), new TAction(array($this, 'onSearch')), 'fa:search');
        $this->form->addAction(_t('New'),  new TAction(array('DisciplinaForm', 'onEdit')), 'bs:plus-sign green');
        
        // creates a DataGrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);
        
        // creates the datagrid columns
        $column_id = new TDataGridColumn('iddisciplina', 'Id', 'center', 50);
        $column_titulo = new TDataGridColumn('titulo', 'Titulo', 'left');
        
        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_titulo);
        
         // creates the datagrid column actions
        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'iddisciplina');
        $column_id->setAction($order_id);
        
        $order_numero = new TAction(array($this, 'onReload'));
        $order_numero->setParameter('order', 'titulo');
        $column_titulo->setAction($order_numero);
        
        // create EDIT action
        $action_edit = new TDataGridAction(array('DisciplinaForm', 'onEdit'));
        $action_edit->setButtonClass('btn btn-default');
        $action_edit->setLabel(_t('Edit'));
        $action_edit->setImage('fa:pencil-square-o blue fa-lg');
        $action_edit->setField('iddisciplina');
        $this->datagrid->addAction($action_edit);
        
        // create DELETE action
        $action_del = new TDataGridAction(array($this, 'onDelete'));
        $action_del->setButtonClass('btn btn-default');
        $action_del->setLabel(_t('Delete'));
        $action_del->setImage('fa:trash-o red fa-lg');
        $action_del->setField('iddisciplina');
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
        
    }
    
}
