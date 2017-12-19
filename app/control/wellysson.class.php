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
    public function __construct()
    {
        parent::__construct();
        
        // load the styles
        TPage::include_css('app/resources/styles.css');
        TPage::include_css('app/resources/font-awesome.min.css');
        TPage::include_css('app/resources/simple-line-icons.css');
        
        // create the HTML Renderer
        $this->html = new THtmlRenderer('app/resources/system_wellysson_pt.html');
        
        try
        {
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

            $sql = "SELECT matricula FROM g_e.aluno;";
            $sql2 = "SELECT idsala FROM g_e.sala;";
            $sql3 = "SELECT idturma FROM g_e.turma;";
            $sql4 = "SELECT iddocente FROM g_e.docente;";
            $sql5 = "SELECT iddisciplina FROM g_e.disciplina;";
            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);
            $result3 = $conn->query($sql3);
            $result4 = $conn->query($sql4);
            $result5 = $conn->query($sql5);

            if ($result->num_rows > 0) {
                $alunos=0;
                while($row = $result->fetch_assoc()) {
                    $alunos++;
                    #$combo_items[$row["idturma"]] =$row["idturma"];
                }
            } else {
                echo "0 results";
            }
            
            if ($result2->num_rows > 0) {
                $salas=0;
                while($row = $result2->fetch_assoc()) {
                    $salas++;
                }
            } else {
                echo "0 results";
            }
            
            if ($result3->num_rows > 0) {
                $turmas=0;
                while($row = $result3->fetch_assoc()) {
                    $turmas++;
                }
            } else {
                echo "0 results";
            }
            
            if ($result4->num_rows > 0) {
                $docentes=0;
                while($row = $result4->fetch_assoc()) {
                    $docentes++;
                }
            } else {
                echo "0 results";
            }
            
            if ($result5->num_rows > 0) {
                $disciplinas=0;
                while($row = $result5->fetch_assoc()) {
                    $disciplinas++;
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            
            $replace['matricula']    = $alunos;
            $replace['salas']    = $salas;
            $replace['turmas']    = $turmas;
            $replace['docentes']    = $docentes;
            $replace['disciplinas']    = $disciplinas;
            
            // replace the main section variables
            $this->html->enableSection('main', $replace);
            
            // define the replacements based on customer contacts
            $replace = array();
            
            
            // define with sections will be enabled
            $this->html->enableSection('contacts');
            $this->html->enableSection('contacts-detail', $replace, TRUE);
            
            // wrap the page content using vertical box
            $vbox = new TVBox;
            #$vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
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
