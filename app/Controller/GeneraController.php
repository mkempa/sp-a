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
    
    public function index($id = '', $parent = '') {
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
        if (!empty($id)) {
            $this->set('back', $this->referer());
        }
        $this->set(compact('data', 'families', 'familiesApg'));
    }

}
