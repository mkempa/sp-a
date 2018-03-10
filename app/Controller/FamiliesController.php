<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP FamiliesController
 * @author Matus
 */
class FamiliesController extends AppController {

    public $uses = array('Family');
    
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
        $data = $this->Family->find('all', array(
            'order' => 'Family.name',
            'recursive' => -1
        ));
        $this->set(compact('data'));
    }
    
    public function detail($id) {
        if ($id == null) {
            throw new InvalidArgumentException("Empty id");
        }
        $result = $this->Family->findById($id);
        $this->set(compact('result'));
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->Family->save($data);
            $this->redirect(array('action' => 'index'));
        }
    }
    
}
