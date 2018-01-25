<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Nomenclature
 * @author Matus
 */
class Nomenclature extends AppModel {

    public $useTable = 'nomenclature';
    public $actsAs = array(
        'Containable'
    );
    public $hasOne = array(
        'NomenStatus' => array(
            'foreignKey' => 'id_nomenclature'
        ),
        'RecordInfo' => array(
            'foreignKey' => 'id_nomenclature'
        )
    );
    public $hasMany = array(
        'BasionymFor' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_basionym'
        ),
        'NomenNovumFor' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_nomen_novum'
        ),
        'ReplacedFor' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_replaced'
        )
    );
    public $belongsTo = array(
        'Accepted' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_accepted_name'
        ),
        'Genus' => array(
            'className' => 'Genus',
            'foreignKey' => 'id_genus'
        ),
        'Basionym' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_basionym'
        ),
        'Replaced' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_replaced'
        ),
        'NomenNovum' => array(
            'className' => 'Nomenclature',
            'foreignKey' => 'id_nomen_novum'
        )
    );
    public $hasAndBelongsToMany = array(
        'SynonymsTaxonomic' => array(
            'className' => 'Nomenclature',
            'joinTable' => 'synonyms',
            'foreignKey' => 'id_parent',
            'associationForeignKey' => 'id_synonym',
            'with' => 'Synonym',
            'conditions' => array(
                'Synonym.syntype' => 2
            ),
            'order' => 'Synonym.rorder'
        ),
        'SynonymsNomenclatoric' => array(
            'className' => 'Nomenclature',
            'joinTable' => 'synonyms',
            'foreignKey' => 'id_parent',
            'associationForeignKey' => 'id_synonym',
            'with' => 'Synonym',
            'conditions' => array(
                'Synonym.syntype' => 3
            ),
            'order' => 'Synonym.rorder'
        ),
        'SynonymsInvalid' => array(
            'className' => 'Nomenclature',
            'joinTable' => 'synonyms',
            'foreignKey' => 'id_parent',
            'associationForeignKey' => 'id_synonym',
            'with' => 'Synonym',
            'conditions' => array(
                'Synonym.syntype' => 1
            ),
            'order' => 'Synonym.rorder'
        )
    );

    public function beforeSave($options = array()) {
        
//        if (isset($this->data['Nomenclature']['id_genus']) && !empty($this->data['Nomenclature']['id_genus'])) {
//            $this->log($this->data, LOG_DEBUG);
//            $this->data['Nomenclature']['genus'] = $genus['Genus']['name'];
//        }
        return true;
    }
    
    public function listSpecies($conditions = array()) {
        $this->recursive = -1;
        return $this->find('all', array(
                    'conditions' => $conditions,
                    'order' => array(
                        'genus',
                        'species',
                        'subsp',
                        'var',
                        'subvar',
                        'forma',
                        'authors',
                        'id'
                    )
        ));
    }

    public function getListOfSpecies($term = null) {
        if (!empty($term)) {
            $termok = '%' . trim($term) . '%';
            $this->recursive = -1;
            $loss = $this->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        'genus ILIKE' => $termok,
                        'species ILIKE' => $termok,
                        'subsp ILIKE' => $termok,
                        'var ILIKE' => $termok,
                        'authors ILIKE' => $termok
                    )
                )
            ));
            return $loss;
        }
        return false;
    }

    public function getDetail($id) {
        if (!$id) {
            throw new InvalidArgumentException('Nomenclature::getDetail - invalid id');
        }
        return $this->find('first', array(
                    'conditions' => array(
                        'Nomenclature.id' => $id
                    ),
                    'contain' => array(
                        'Genus' => array(
                            'Family',
                            'FamilyApg'
                        ),
                        'Accepted',
                        'Basionym',
                        'BasionymFor',
                        'Replaced',
                        'ReplacedFor',
                        'NomenNovum',
                        'NomenNovumFor',
                        'SynonymsInvalid',
                        'SynonymsTaxonomic' => array(
                            'SynonymsNomenclatoric' => array(
                                /* 'conditions' => array(  //in admin, we want to see all nomenclatoric synonyms
                                  'show_in_tree' => true
                                  ), */
                                'order' => 'rorder'
                            )
                        ),
                        'SynonymsNomenclatoric'
                    )
        ));
    }

}
