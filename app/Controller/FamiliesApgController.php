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
    
    public function index($id = '', $parent = '') {
        $data = $this->FamilyApg->find('all', array(
            'order' => 'FamilyApg.name',
            'recursive' => -1
        ));
        if (!empty($parent)) {
            $this->set(cmpact('parent'));
        }
        $this->set(compact('data'));
    }
    
}
