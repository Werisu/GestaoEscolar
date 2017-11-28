<?php
/**
 * wellysson
 *
 * @version    1.0
 * @package    control
 * @author     Wellysson Nascimento Rocha
 * @copyright  Copyright (c) 2017 Devulpis Solutions Ltd. (http://www.devulpis.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class wellysson extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        //$html1 = new THtmlRenderer('app/resources/system_welcome_en.html');
        $html2 = new THtmlRenderer('app/resources/system_wellysson_pt.html');

        // replace the main section variables
        //$html1->enableSection('main', array());
        $html2->enableSection('main', array());
        
        //$panel1 = new TPanelGroup('Welcome!');
        //$panel1->add($html1);
        
        $panel2 = new TPanelGroup('Bem-vindo!');
        $panel2->add($html2);
        
        // add the template to the page
        parent::add( TVBox::pack($panel2) );
    }
}
