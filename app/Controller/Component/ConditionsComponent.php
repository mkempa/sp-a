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
        if (!empty($text)) {
            $nomen = $this->_freetextNomen($text, 'Nomenclature');
            $accepted = $this->_freetextNomen($text, 'Accepted');
            
            $conditions['OR'] = Hash::merge($nomen, $accepted);
        }
    }
    
    private function _freetextNomen($text, $class) {
        $c = array();
        $c[$class . '.genus LIKE'] = "%$text%";
        $c[$class . '.species LIKE'] = "%$text%";
        $c[$class . '.subsp LIKE'] = "%$text%";
        $c[$class . '.var LIKE'] = "%$text%";
        $c[$class . '.subvar LIKE'] = "%$text%";
        $c[$class . '.forma LIKE'] = "%$text%";
        $c[$class . '.nothosubsp LIKE'] = "%$text%";
        $c[$class . '.nothoforma LIKE'] = "%$text%";
        $c[$class . '.authors LIKE'] = "%$text%";
        $c[$class . '.genus_h LIKE'] = "%$text%";
        $c[$class . '.species_h LIKE'] = "%$text%";
        $c[$class . '.subsp_h LIKE'] = "%$text%";
        $c[$class . '.var_h LIKE'] = "%$text%";
        $c[$class . '.subvar_h LIKE'] = "%$text%";
        $c[$class . '.forma_h LIKE'] = "%$text%";
        $c[$class . '.nothosubsp_h LIKE'] = "%$text%";
        $c[$class . '.nothoforma_h LIKE'] = "%$text%";
        $c[$class . '.authors_h LIKE'] = "%$text%";
        $c[$class . '.publication LIKE'] = "%$text%";
        $c[$class . '.tribus LIKE'] = "%$text%";
        $c[$class . '.vernacular LIKE'] = "%$text%";
        return $c;
    }
    
}
