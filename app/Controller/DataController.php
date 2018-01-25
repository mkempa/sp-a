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

    public $uses = array('Family', 'FamilyApg', 'Genus', 'Nomenclature', 'User');
    public $helpers = array(
        'Paginator',
        'Eip.Eip',
        'Edit'
    );
    public $components = array(
        'Paginator',
        'Eip.Eip',
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
        $generaIds = $this->Utils->userGenera($this->User);
        
        $this->Paginator->settings = array(
            'Nomenclature' => array(
                'contain' => array(
                    'Accepted',
//                    'Basionym',
//                    'BasionymFor',
//                    'Replaced',
//                    'ReplacedFor'
                ),
                'conditions' => $this->Conditions->viewFilter($filterrecords, $generaIds),
                'limit' => 50,
                'order' => array(
                    'Nomenclature.id'
                )
            )
        );
        $data = $this->Paginator->paginate('Nomenclature', array(), array(
            'Nomenclature.id'
        ));
        
        $this->set(compact('data', 'filterrecords'));
    }

    public function detail($id) {
        if (!$id) {
            throw new InvalidArgumentException('ChecklistsController::detail - invalid id');
        }
        ini_set('memory_limit', '256M');
        $result = $this->Nomenclature->getDetail($id);
        $accepted = $this->Nomenclature->listSpecies(array('ntype' => array('A', 'PA')));
        $loss = $this->Nomenclature->listSpecies();
        $genera = $this->Genus->listGenera();
        $familiesApg = $this->Family->listFamilies();
        $families = $this->FamilyApg->listFamilies();
        $this->set(compact('accepted', 'families', 'familiesApg', 'genera', 'loss', 'result'));
    }

}
