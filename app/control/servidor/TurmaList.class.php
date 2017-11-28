<?php

/**
 * A classe TurmaList.class.php vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, Wellysson Rocha
 * @version 1.0
 */
class TurmaList extends \Adianti\Control\TPage{
    //put your code here
    
    private $datagrid;
    private $loaded;
            
    function __construct() {
        parent::__construct();
        
        $this->datagrid = new Adianti\Widget\Wrapper\TQuickGrid;
        $this->datagrid->addQuickColumn('ID da Turma', 'id', 'right');
        $this->datagrid->addQuickColumn('Turno', 'turno', 'left');
        
        $edit = new \Adianti\Widget\Datagrid\TDataGridAction(array('TurmaForm','onEdit'));
        $this->datagrid->addQuickAction('Editar', $edit, 'id', 'ico_edit.png');
        $this->datagrid->createModel();
        
        parent::add($this->datagrid);
    }
    
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
    }
}
