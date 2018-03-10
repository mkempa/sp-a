<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP FamiliesApgController
 * @author Matus
 */
class FamiliesApgController extends AppController {

    public $uses = array('FamilyApg');
    
    public $helpers = array(
        'Eip.Eip'
    );
    
    public $components = array(
        'Eip.Eip'
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
        $data = $this->FamilyApg->find('all', array(
            'order' => 'FamilyApg.name',
            'recursive' => -1
        ));
        $this->set(compact('data'));
    }
    
    public function detail($id) {
        if ($id == null) {
            throw new InvalidArgumentException("Empty id");
        }
        $result = $this->FamilyApg->findById($id);
        $this->set(compact('result'));
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->FamilyApg->save($data);
            $this->redirect(array('action' => 'index'));
        }
    }
    
}
