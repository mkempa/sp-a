<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP DataController
 * @author Matus
 */
class DataController extends AppController {

    public $uses = array('Family', 'FamilyApg', 'Genus', 'Nomenclature', 'Synonym', 'User');
    public $helpers = array(
        'Paginator',
        'Eip.Eip',
        'Edit'
    );
    public $components = array(
        'Paginator',
        'Eip.Eip',
        'Input',
        'Conditions',
        'Utils'
    );

    public function isAuthorized($user) {
        if ($user['role'] === AUTHOR) {
            $this->set(AUTHORIZED_EDIT, false);
        }
        return true;
    }

    public function index() {
        $params = $this->request->query;
        $filterrecords = $this->Utils->filterRecords($params);
        $checkedTypes = $this->Utils->filterTypes($params);
        $generaIds = $this->Utils->userGenera($this->User);
        $freetext = $this->Utils->filterFreetext($params);
        
        $conditions = array();
        $this->Conditions->ownership($filterrecords, $generaIds, $conditions);
        $this->Conditions->types($checkedTypes, $conditions);
        $this->Conditions->freetext($freetext, $conditions);
        
        $this->Paginator->settings = array(
            'Nomenclature' => array(
                'contain' => array(
                    'Accepted'
//                    'Basionym',
//                    'BasionymFor',
//                    'Replaced',
//                    'ReplacedFor'
                ),
                'conditions' => $conditions,
                'limit' => 50,
                'order' => array(
                    'Nomenclature.id'
                )
            )
        );
        $data = $this->Paginator->paginate('Nomenclature');
        
        $this->set(compact('data', 'filterrecords', 'checkedTypes', 'freetext'));
    }

    public function detail($id) {
        if (!$id) {
            throw new InvalidArgumentException('ChecklistsController::detail - invalid id');
        }
        ini_set('memory_limit', '512M');
        $result = $this->Nomenclature->getDetail($id);
        $accepted = $this->Nomenclature->listSpecies(array('ntype' => array('A', 'PA')));
        $loss = $this->Nomenclature->listSpecies();
        $genera = $this->Genus->listGenera();
//        $familiesApg = $this->Family->listFamilies();
//        $families = $this->FamilyApg->listFamilies();
//        $this->set(compact('accepted', 'families', 'familiesApg', 'genera', 'loss', 'result'));
        $this->set(compact('accepted', 'genera', 'loss', 'result'));
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->Nomenclature->saveAssociated($data);
            $this->redirect(array('action' => 'index'));
        }
        ini_set('memory_limit', '256M');
        $accepted = $this->Nomenclature->listSpecies(array('ntype' => array('A', 'PA')));
        $loss = $this->Nomenclature->listSpecies();
        $genera = $this->Genus->listGenera();
        $this->set(compact('accepted', 'genera', 'loss'));
    }

    public function edit($id) {
        if (!$id) {
            throw new InvalidArgumentException('ChecklistsController::edit - invalid id');
        }
        ini_set('memory_limit', '512M');
        //$result = $this->Nomenclature->getDetail($id);
        $nomenclatoric = $this->Synonym->find('all', array(
            'contain' => array('SynonymSpecies'),
            'conditions' => array('Synonym.id_parent' => $id, 'Synonym.syntype' => 3),
            'order' => $this->Input->orderNomen('SynonymSpecies')
        ));
        $taxonomic = $this->Synonym->find('all', array(
            'contain' => array('SynonymSpecies'),
            'conditions' => array('Synonym.id_parent' => $id, 'Synonym.syntype' => 2),
            'order' => $this->Input->orderNomen('SynonymSpecies')
        ));
        $parentId = $id;
        $synonyms = $this->Nomenclature->find('all', array(
            'recursive' => -1,
            'conditions' => array('Nomenclature.ntype' => array('S', 'DS'))
        ));
        $this->set(compact('parentId', 'nomenclatoric', 'synonyms', 'taxonomic'));
    }
            
    
}
