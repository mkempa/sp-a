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
    
    public function index($id = '') {
        $data = $this->Family->find('all', array(
            'order' => 'Family.name',
            'recursive' => -1
        ));
        if (!empty($id)) {
            $this->set('back', $this->referer());
        }
        $this->set(compact('data'));
    }
    
}
