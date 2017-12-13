<?php

/**
 * A classe Pessoa.class.php vai ser a classe mais complicada de se implementar, não sei se conseguirei.
 *
 * @author Wellysson Rocha
 * @copyright (c) 2017, John Doe
 * @version 1.0
 */
class AdminView2 extends \Adianti\Control\TPage {
    //put your code here
    
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        // load the styles
        TPage::include_css('app/resources/styles.css');
        
        // create the HTML Renderer
        $this->html = new THtmlRenderer('app/resources/telas/master.html');
        
        try
        {
            // look for customer 1
            TTransaction::open('gestao_escolar');
            $customer = new Sala();
            
            // define replacements for the main section
            $replace = array();
            $replace['idSala']    = $customer->id;
            $replace['numero']    = $customer->name;
            
            // replace the main section variables
            $this->html->enableSection('main', $replace);
            
            include 'app/config/gestaoescolar.ini.php';
            $result = mysqli_query($conn, 'SELECT `idSala`, numero FROM sala');
            $i=0;
            while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                ++$i;
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            
            $panel = new TPanelGroup('Line chart');
            
            echo $i;
            
            $number = $i;
            
            // define the replacements based on customer contacts
            $replace = array();
            foreach ($result as $contact)
            {
                $replace[] = array('number' => $contact->$i,
                                   'value'=> $contact->value);
            }
            
            // define with sections will be enabled
            $this->html->enableSection('contacts');
            $this->html->enableSection('contacts-detail', $replace, TRUE);
            
            // wrap the page content using vertical box
            $vbox = new TVBox;
            $vbox->add($this->html);
    
            parent::add($vbox);            
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
}
