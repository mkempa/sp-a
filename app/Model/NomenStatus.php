<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP NomenStatus
 * @author Matus
 */
class NomenStatus extends AppModel {
    
    public $useTable = 'nomen_status';
    
    public $belognsTo = array(
        'Nomenclature' => array(
            'foreignKey' => 'id_nomenclature'
        )
    );
    
}
