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
    
    private $restricted = array('detail', 'add');
    
    public function isAuthorized($user) {
        if ($user['role'] === AUTHOR) {
            $this->set(AUTHORIZED_EDIT, false);
            if (in_array($this->action, $this->restricted)) {
                return false;
            }
        }
        return true;
    }
    
    public function index() {
        $this->Paginator->settings = array(
            'Genus' => array(
                'limit' => 50,
                'order' => array(
                    'Genus.name',
                    'Genus.authors',
                    'Genus.id'
                )
            )
        );
        $data = $this->Paginator->paginate('Genus');
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
    
    public function add() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->Genus->save($data);
            $this->redirect(array('action' => 'index'));
        }
        $familiesApg = $this->FamilyApg->listFamilies();
        $families = $this->Family->listFamilies();
        $this->set(compact('familiesApg', 'families'));
    }
    
}
