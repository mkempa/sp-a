<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP FamilyApg
 * @author Matus
 */
class FamilyApg extends AppModel {
    
    public $useTable = 'family_apg';
    public $actsAs = array(
        'Containable'
    );
    
    public $hasMany = array(
        'Genus' => array(
            'foreignKey' => 'id_family_apg'
        )
    );
    
    public function listFamilies($conditions = array()) {
        $this->recursive = -1;
        return $this->find('list', array(
            'fields' => array('FamilyApg.id', 'FamilyApg.name'),
            'conditions' => $conditions,
            'order' => 'FamilyApg.name'
        ));
    }
    
}
