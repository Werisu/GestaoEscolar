<?php

/**
 * A classe Pessoa.class.php não esta sendo utilizado.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class AdminView extends \Adianti\Base\TStandardList {
    
    public $tema;
    protected $datagrid;
    
    public function __construct($show_breadcrumb = true) {
        parent::__construct();
        
        parent::setDatabase('permission');
        parent::setActiveRecord('SystemUser');
        parent::setDefaultOrder('id', 'asc');
        parent::addFilterField('id', '=', 'id');
        parent::addFilterField('email', 'like', 'email');
        parent::addFilterField('email', 'like', 'email');        
        $this->datagrid = new \Adianti\Wrapper\BootstrapDatagridWrapper(new \Adianti\Widget\Datagrid\TDataGrid);
        
        // creates the datagrid columns
        $column_id = new TDataGridColumn('id', 'Id', 'center', 50);
        $column_ativo = new TDataGridColumn('email', 'Email', 'left');
        
        // add the columns to the DataGrid
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_ativo);
        
        // creates the datagrid column actions
        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);
        
        $order_ativo = new TAction(array($this, 'onReload'));
        $order_ativo->setParameter('order', 'email');
        $column_ativo->setAction($order_ativo);
        
        // create the datagrid model
        $this->datagrid->createModel();
        
//        $panel = new TPanelGroup('Pure Bootstrap Datagrid');
//        $panel->add($this->datagrid);
//        $panel->addFooter('footer');
        
        //Painel Gráfico
        $html = new THtmlRenderer('app/resources/google_pie_chart.html');
        $html2 = new THtmlRenderer('app/resources/system_welcome_pt.html');
        $data = array();
        
        $conn1 = mysqli_connect('localhost', 'root', '', 'gestao_escolar');
        if (!$conn1) {
            die('Could not connect to MySQL: ' . mysqli_connect_error());
        }
        mysqli_query($conn1, 'SET NAMES \'utf8\'');
// TODO: insert your code here.
        
        $result = mysqli_query($conn1, 'SELECT `idSala`, numero FROM sala');
        $i=0;
        while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
            ++$i;
        }
        mysqli_free_result($result);
        mysqli_close($conn1);
        
        if($result):
            
        
        
        $data[] = [ 'Predio', 'Value' ];
        $data[] = [ 'Sala',   $i ];
        $data[] = [ 'Laboratórios',   1 ];
        $data[] = [ 'Gestão',    1 ];
        
        $panel = new TPanelGroup('Line chart');
        //$panel->style = 'width: 50%';
        $panel->add($html);
        
        // replace the main section variables
        $html->enableSection('main', array('data'   => json_encode($data),
                                           'width'  => '100%',
                                           'height'  => '300px',
                                           'title'  => 'Acessado no dia: ' . date('d/m/Y'),
                                           'ytitle' => 'Accesses', 
                                           'xtitle' => 'Day',
                                           'uniqid' => uniqid()));
        else:
            echo " - Cadastre as salas";
        endif;
        
         // vertical box container
        $container = new TVBox;
        $container->style = 'width: 40%';
        $container->style = 'padding-top: 1%';
        $container->add(TPanelGroup::pack('', $this->datagrid));
        $container->add($panel);
        $container->add($this->pageNavigation);
        
        parent::add($container);
        
    }
}
