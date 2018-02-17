<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormatHelper
 *
 * @author Matus
 */
class FormatHelper extends AppHelper {
 
    public function los($name, $options = array()) {
        if (empty($name)) {
            return null;
        }
        $options = array_merge(array(
            'special' => '',
            'publication' => true,
            'tribus' => true,
            'italic' => false,
            'debug' => false
                ), (array) $options);

        $special = $options['special'];
        $publication = $options['publication'];
        $tribus = $options['tribus'];

        if (isset($name['name'])) {
            return $publication ? $name['name'] . ", " . $name['publication'] : $name['name'];
        }
        $syntype = $name['syn_type'];
        if (!empty($special) && isset($name[$special]) && $name[$special]) {
            $syntype = 1;
        }
        $out = $this->_los($name['genus'], $name['species'], $name['subsp'], $name['var'], $name['subvar'], $name['forma'], $name['authors'], array(
            'publication' => ($publication ? $name['publication'] : ''),
            'ishybrid' => $name['hybrid'],
            'syntype' => $syntype,
            'genus_h' => $name['genus_h'],
            'species_h' => $name['species_h'],
            'subsp_h' => $name['subsp_h'],
            'var_h' => $name['var_h'],
            'subvar_h' => $name['subvar_h'],
            'forma_h' => $name['forma_h'],
            'authors_h' => $name['authors_h'],
            'tribus' => ($tribus && $name['tribus'] ? $name['tribus'] : ''),
            'italic' => $options['italic']
        ));
        // prepend id if debug is true
        $prep = $options['debug'] && isset($name['id']) && !empty($name['id']) ? ($name['id'] . ' - ') : '';
        return $prep . $out;
    }
    
    public function type($type, $options = array()) {
        $options = array_merge(array(
            'html' => false
                ), (array) $options);
        $isHtml = $options['html'];
        switch ($type) {
            case 'A' :
                return $this->_strOrHtml('Accepted', $isHtml);
            case 'PA' :
                return $this->_strOrHtml('Provosionally Accepted', $isHtml);
            case 'S' :
                return $this->_strOrHtml('Synonym', $isHtml);
            case 'DS' :
                return $this->_strOrHtml('Doubtful Synonym', $isHtml);
            case 'U' :
                return $this->_strOrHtml('Unresolved', $isHtml);
            case 'H' :
                return $this->_strOrHtml('Hybrid', $isHtml);
        }
    }

    public function navbarActive($idOne, $idTwo) {
        if ($idOne == $idTwo) {
            return ' class="active"';
        }
        return '';
    }
    
    public function checkClass($expected, $actual, $class) {
        if (!empty($actual) && $actual === $expected) {
            return $class;
        }
        return '';
    }
    
    public function checkOption(array $expected, $actual) {
        return in_array($actual, $expected);
    }
    
    private function _strOrHtml($string, $isHtml = false) {
        if (empty($string)) {
            return $string;
        }
        $string = trim($string);
        if ($isHtml) {
            $class = str_replace(array(
                ' ',
                '_'
                    ), '-', $string);
            return '<span class="' . strtolower($class) . '">' . $string . '</span>';
        }
        return $string;
    }
    
    private function _los($genus, $species, $subsp, $var, $subvar, $forma, $authors, $options = array()) {
        $options = array_merge(array(
            'publication' => '',
            'ishybrid' => false,
            'syntype' => '',
            'genus_h' => '',
            'species_h' => '',
            'subsp_h' => '',
            'var_h' => '',
            'subvar_h' => '',
            'forma_h' => '',
            'authors_h' => '',
            'tribus' => '',
            'italic' => true
                ), (array) $options);

        $publication = $options['publication'];
        $hybrid = $options['ishybrid'];
        $syntype = $options['syntype'];
        $genus_h = $options['genus_h'];
        $species_h = $options['species_h'];
        $subsp_h = $options['subsp_h'];
        $var_h = $options['var_h'];
        $subvar_h = $options['subvar_h'];
        $forma_h = $options['forma_h'];
        $authors_h = $options['authors_h'];
        $tribus = $options['tribus'];
        $italic = $options['italic'];

        $name = '';
        $autLast = true;
        $sl = false;
        $name .= $syntype == '1' ? '"' : '';
        if (strpos($species, 's.l.')) {
            $species = trim(str_replace('s.l.', '', $species));
            $sl = true;
        }
        $name .= $italic ? "<i>$genus $species</i>" : "$genus $species";
        $name .= $sl ? ' s.l.' : '';
        if (trim($subsp) == trim($species) || trim($var) == trim($species) || trim($forma) == trim($species)) {
            $name .= " $authors";
            $autLast = false;
        }
        if (!empty($subsp)) {
            $subsp_r = $subsp;
            $subsp_n = "";
            if (strpos($subsp, "[unranked]") !== false) {
                $subsp_r = str_replace("[unranked]", "", $subsp_r);
                $subsp_n .= ' [unranked]';
            }
            if (strpos($subsp, "proles") !== false) {
                $subsp_r = str_replace("proles", "", $subsp_r);
                $subsp_n .= ' "proles"';
            }
            $subsp_r = $italic ? ("<i>" . trim($subsp_r) . "</i>") : trim($subsp_r);
            $name .= !empty($subsp_n) ? " $subsp_n $subsp_r" : " subsp. $subsp_r";
        }
        if (!empty($var)) {
            $var = $italic ? "<i>$var</i>" : $var;
            $name .= " var. $var";
        }
        if (!empty($subvar)) {
            $subvar = $italic ? "<i>$subvar</i>" : $subvar;
            $name .= " subvar. $subvar";
        }
        if (!empty($forma)) {
            $forma = $italic ? "<i>$forma</i>" : $forma;
            $name .= " forma $forma";
        }
        if ($autLast) {
            $name .= " $authors";
        }
        if ($hybrid) {
            $name .= " x ";
            $name .= $this->_los($genus_h, $species_h, $subsp_h, $var_h, $subvar_h, $forma_h, $authors_h, array(
                'italic' => $italic
            ));
        }
        $name .= $syntype == '1' ? '"' : '';
        return $name . (empty($publication) ? '' : ', ' . $publication) . (empty($tribus) ? '' : ' (tribus ' . $tribus . ')');
    }
    
}
