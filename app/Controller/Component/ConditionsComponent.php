<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP ConditionsComponent
 * @author Matus
 */
class ConditionsComponent extends Component {

    public function ownership($type, $ids, &$conditions) {
        if ($type === 'mine') {
            $conditions['Nomenclature.id_genus'] = $ids;
        }
    }

    public function types($types, &$conditions) {
        if (!in_array('All', $types)) {
            $conditions['Nomenclature.ntype'] = $types;
        }
    }

    public function freetext($text, &$conditions) {
        
    }
    
}
