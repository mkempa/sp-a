<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP GeneraController
 * @author Matus
 */
class GeneraController extends AppController {

    public $uses = array('Family', 'FamilyApg', 'Genus');
    
    public $helpers = array(
        'Edit',
        'Eip.Eip',
        'Format',
        'Paginator'
    );
    
    public $components = array(
        'Eip.Eip',
        'Paginator',
        'Utils'
    );
    
    public function index() {
        $this->Paginator->settings = array(
            'Genus' => array(
                'limit' => 50,
                'order' => array(
                    'Genus.id'
                )
            )
        );
        $data = $this->Paginator->paginate('Genus', array(), array(
            'Genus.id'
        ));
        $familiesApg = $this->FamilyApg->listFamilies();
        $families = $this->Family->listFamilies();
        $this->set(compact('data', 'families', 'familiesApg'));
    }

    public function detail($id) {
        if ($id == null) {
            throw new InvalidArgumentException("Empty id");
        }
        $result = $this->Genus->find('first', array(
            'contain' => array(
                'Family',
                'FamilyApg'
            ),
            'conditions' => array('Genus.id' => $id)
        ));
        $familiesApg = $this->FamilyApg->listFamilies();
        $families = $this->Family->listFamilies();
        $this->set(compact('result', 'families', 'familiesApg'));
    }
    
}
