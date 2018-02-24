<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Synonym
 * @author Matus
 */
class Synonym extends AppModel {

    public $actsAs = array(
        'Containable'
    );

    public $belongsTo = array(
        'Parent' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_parent'
        ),
        'SynonymSpecies' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_synonym'
        )
    );
    
}
