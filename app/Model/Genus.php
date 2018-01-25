<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Genus
 * @author Matus
 */
class Genus extends AppModel {

    public $useTable = 'genus';
    public $actsAs = array(
        'Containable'
    );
    
    public $hasMany = array(
        'Nomenclature' => array(
            'foreignKey' => 'id_genus'
        )
    );
    public $belongsTo = array(
        'Family' => array(
            'class' => 'Family',
            'foreignKey' => 'id_family'
        ),
        'FamilyApg' => array(
            'class' => 'FamilyApg',
            'foreignKey' => 'id_family_apg'
        )
    );

    public function listGenera($conditions = array()) {
        $this->recursive = 0;
        return $this->find('list', array(
            'fields' => array('Genus.id', 'Genus.name'),
            'conditions' => $conditions,
            'order' => 'Genus.name'
        ));
    }
    
}
