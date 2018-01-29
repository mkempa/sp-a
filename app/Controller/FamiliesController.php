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
    
}
