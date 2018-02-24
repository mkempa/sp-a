<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP InputComponent
 * @author Matus
 */
class InputComponent extends Component {

    public function orderNomen($table) {
        return array(
            "$table.genus",
            "$table.species",
            "$table.subsp",
            "$table.var",
            "$table.subvar",
            "$table.forma",
            "$table.authors",
            "$table.genus_h",
            "$table.species_h",
            "$table.subsp_h",
            "$table.var_h",
            "$table.subvar_h",
            "$table.forma_h",
            "$table.authors_h",
            "$table.id"
        );
    }

    public function syntype($syntype) {
        switch ($syntype) {
            case 'nomenclatoric':
                return 3;
            case 'taxonomic':
                return 2;
            default:
                return 2;
        }
    }
}
