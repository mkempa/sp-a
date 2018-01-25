<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP RecordInfo
 * @author Matus
 */
class RecordInfo extends AppModel {
    
    public $useTable = 'record_info';
    
    public $belongsTo = array(
        'Nomenclature' => array(
            'foreignKey' => 'id_nomenclature'
        )
    );
    
}
