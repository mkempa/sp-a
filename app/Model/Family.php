<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Family
 * @author Matus
 */
class Family extends AppModel {
    
    public $useTable = 'family';
    public $actsAs = array('Containable');
    
    public $hasMany = array(
        'Genus' => array(
            'foreignKey' => 'id_family'
        )
    );
    
    public function listFamilies($conditions = array()) {
        $this->recursive = 0;
        return $this->find('list', array(
            'fields' => array('Family.id', 'Family.name'),
            'conditions' => $conditions,
            'order' => array('Family.name' => 'ASC')
        ));
    }
    
}
