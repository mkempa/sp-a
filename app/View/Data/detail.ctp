<?php
//new dBug($result);

$ntypes = array(
    'A' => 'Accepted',
    'PA' => 'Provisionally Accepted',
    'S' => 'Synonym',
    'DS' => 'Doubtful Synonym',
    'U' => 'Unresolved',
    'H' => 'Hybrid'
);

$loss_list = Hash::combine($loss, '{n}.Nomenclature.id', '{n}');
unset($loss);

foreach ($loss_list as $key => $val) {
    $l = $this->Format->los($val['Nomenclature']);
    $loss_list[$key] = $l;
}

$accepted_list = Hash::combine($accepted, '{n}.Nomenclature.id', '{n}');
unset($accepted);

foreach ($accepted_list as $key => $val) {
    $l = $this->Format->los($val['Nomenclature']);
    $accepted_list[$key] = $l;
}
?>

<div id="checklist-detail" class="container">

    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $result['Nomenclature']['id']), array('class' => 'btn btn-default')); ?>

    <h3><?php echo __('Name'); ?></h3>
    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Family APG-4'); ?></td>
            <td><?php echo Hash::get($result, 'Genus.FamilyApg.name'); //echo $this->Edit->eipInput($result, 'Genus.id_family_apg', array('editable' => $authorizedEdit, 'type' => 'select', 'source' => $familiesApg, 'display' => Hash::get($result, 'Genus.FamilyApg.name'))); ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Family'); ?></td>
            <td><?php echo Hash::get($result, 'Genus.Family.name'); ?></td>
        </tr>
    </table>
    
    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Genus'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.id_genus', array(
                'editable' => $authorizedEdit, 
                'type' => 'select', 
                'source' => $genera, 
                'display' => Hash::get($result, 'Genus.name'),
                'viewSelect' => true,
                'viewUrl' => $this->Html->url(array(
                    'controller' => 'genera', 
                    'action' => 'index', 
                    'id' => Hash::get($result, 'Nomenclature.id_genus'), 
                    'parent' => Hash::get($result, 'Nomenclature.id')))
                )); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Species'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.species', array('editable' => $authorizedEdit)); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Subsp'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.subsp', array('editable' => $authorizedEdit)); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Var'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.var', array('editable' => $authorizedEdit)); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Subvar'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.subvar', array('editable' => $authorizedEdit)); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Forma'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.forma', array('editable' => $authorizedEdit)); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Authors'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.authors', array('editable' => $authorizedEdit)); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Type'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.ntype', array('editable' => $authorizedEdit, 'type' => 'select', 'source' => $ntypes, 'display' => $this->Format->type($result['Nomenclature']['ntype']))); ?> </td>
        </tr>
    </table>

    <div id="hybrid-fields" class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title clickable">
                    <a data-toggle="collapse" href="#collapse1">
                        Hybrid fields
                        <span class="pull-right">&blacktriangledown;</span>
                    </a>
                </h4>
            </div>
            <?php
            $is_hybrid = Hash::get($result, 'Nomenclature.hybrid');
            ?>
            <div id="collapse1" class="panel-collapse collapse<?php echo $is_hybrid ? ' in' : ''; ?>">
                <table class="table table-bordered table-condensed table-responsive">
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Genus'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.genus_h', array('editable' => $authorizedEdit)); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Species'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.species_h', array('editable' => $authorizedEdit)); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Subsp'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.subsp_h', array('editable' => $authorizedEdit)); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Var'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.var_h', array('editable' => $authorizedEdit)); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Subvar'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.subvar_h', array('editable' => $authorizedEdit)); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Forma'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.forma_h', array('editable' => $authorizedEdit)); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Authors'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.authors_h', array('editable' => $authorizedEdit)); ?> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Publication'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.publication', array('editable' => $authorizedEdit)); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Tribus'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.tribus', array('editable' => $authorizedEdit)); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Is isonym'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.is_isonym', array('editable' => $authorizedEdit, 'isBool' => true, 'valTrue' => 'True', 'valFalse' => 'False')); ?> </td>
        </tr>
    </table>

    <h3><?php echo __('Associations'); ?></h3>
    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Accepted name'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.id_accepted_name', array(
                'editable' => $authorizedEdit, 
                'type' => 'select', 
                'source' => $accepted_list, 
                'display' => $this->Format->los(Hash::get($result, 'Accepted')),
                'viewSelect' => true,
                'viewUrl' => $this->Html->url("/data/detail/" . Hash::get($result, 'Accepted.id'))
                )); ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Basionym'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.id_basionym', array(
                'editable' => $authorizedEdit, 
                'type' => 'select', 
                'source' => $loss_list, 
                'display' => $this->Format->los(Hash::get($result, 'Basionym')),
                'viewSelect' => true,
                'viewUrl' => $this->Html->url("/data/detail/" . Hash::get($result, 'Nomenclature.id_basionym'))
                )); ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Replaced name'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.id_replaced', array(
                'editable' => $authorizedEdit, 
                'type' => 'select', 
                'source' => $loss_list, 
                'display' => $this->Format->los(Hash::get($result, 'Replaced')),
                'viewSelect' => true,
                'viewUrl' => $this->Html->url("/data/detail/" . Hash::get($result, 'Nomenclature.id_replaced'))
                )); ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Nomen novum'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.id_nomen_novum', array(
                'editable' => $authorizedEdit, 
                'type' => 'select', 
                'source' => $loss_list, 
                'display' => $this->Format->los(Hash::get($result, 'Nomen novum')),
                'viewSelect' => true,
                'viewUrl' => $this->Html->url("/data/detail/" . Hash::get($result, 'Nomenclature.id_nomen_novum'))
                )); ?></td>
        </tr>
    </table>

    <h3>
        <?php echo __('Nomenclatoric Synonyms'); ?>
        <small><?php echo __('(Synonyms can be managed only in ') . $this->Html->link('full edit mode', array('action' => 'edit', $result['Nomenclature']['id'], '#' => 'nomenclatoric')) . ')'; ?></small>
    </h3>
    <table class="table table-condensed table-responsive table-bordered">
        <?php if (empty($result['SynonymsNomenclatoric'])): //show one empty row  ?>
            <tr><td></td></tr>
        <?php endif; ?>
        <?php foreach ($result['SynonymsNomenclatoric'] as $sn) : ?>
            <tr>
                <td class="col-xs-1">&#8801;</td>
                <td>
                    <?php
                    $sn_name = $this->Format->los($sn, array('special' => $sn['is_isonym']));
                    echo $this->Html->link($sn_name, array('action' => 'detail', $sn['id']));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>
        <?php echo __('Taxonomic Synonyms'); ?>
        <small><?php echo __('(Synonyms can be managed only in ') . $this->Html->link('full edit mode', array('action' => 'edit', $result['Nomenclature']['id'], '#' => 'taxonomic')) . ')'; ?></small>
    </h3>
    <p>
        All associated nomenclatoric synonyms are shown here to see which are associated with each other. Those in grey colour will not be shown on the website.
        <?php echo $this->Html->link('(Example)', '/checklist/detail/335'); ?>
    </p>
    <table class="table table-condensed table-responsive table-bordered">
        <?php if (empty($result['SynonymsTaxonomic'])): //show one empty row  ?>
            <tr><td></td></tr>
        <?php endif; ?>
        <?php foreach ($result['SynonymsTaxonomic'] as $st) : ?>
            <tr>
                <td class="col-xs-1">=</td>
                <td>
                    <?php
                    $st_name = $this->Format->los($st, array('special' => $st['is_isonym']));
                    echo $this->Html->link($st_name, array('action' => 'detail', $st['id']));
                    ?>
                    <ul class="normal">
                        <?php
                        foreach ($st['SynonymsNomenclatoric'] as $st_n):
                            $st_n_name = $this->Format->los($st_n, array('special' => $st['is_isonym']));
                            $is_shown = Hash::get($st_n, 'Synonym.show_in_tree') ? '' : 'class="grey"';
                            ?>
                            <li <?php echo $is_shown; ?>>
                                <span class="col-xs-1">&#8801;</span>
                                <span class="col-xs-11"><?php echo $this->Html->link($st_n_name, array('action' => 'detail', $st_n['id'])); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>
        <?php echo __('Invalid designations'); ?>
    </h3>
    <table class="table table-condensed table-responsive table-bordered">
        <?php if (empty($result['SynonymsInvalid'])): //show one empty row  ?>
            <tr><td></td></tr>
        <?php endif; ?>
        <?php foreach ($result['SynonymsInvalid'] as $ind) : ?>
            <tr>
                <td>
                    <?php
                    $ind_name = $this->Format->los($ind, array('special' => $ind['is_isonym']));
                    echo $this->Html->link($ind_name, array('action' => 'detail', $ind['id']));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>
        <?php echo __('Basionym for'); ?>
        <small><?php echo __('(Only if this name is a basionym)'); ?></small>
    </h3>
    <table class="table table-condensed table-responsive table-bordered">
        <?php if (empty($result['BasionymFor'])): //show one empty row  ?>
            <tr><td></td></tr>
        <?php endif; ?>
        <?php foreach ($result['BasionymFor'] as $bf) : ?>
            <tr>
                <td>
                    <?php
                    $bf_name = $this->Format->los($bf, array('special' => $bf['is_isonym']));
                    echo $this->Html->link($bf_name, array('action' => 'detail', $bf['id']));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>
        <?php echo __('Replaced name for'); ?>
        <small><?php echo __('(Only if this name is a replaced name)'); ?></small>
    </h3>
    <table class="table table-condensed table-responsive table-bordered">
        <?php if (empty($result['ReplacedFor'])): //show one empty row  ?>
            <tr><td></td></tr>
        <?php endif; ?>
        <?php foreach ($result['ReplacedFor'] as $rf) : ?>
            <tr>
                <td>
                    <?php
                    $rf_name = $this->Format->los($rf, array('special' => $rf['is_isonym']));
                    echo $this->Html->link($rf_name, array('action' => 'detail', $rf['id']));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="col-xs-6"><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $result['Nomenclature']['id']), array('class' => 'btn btn-default')); ?></div>
    <div class="col-xs-6"><?php echo $this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-default')); ?></div>

</div>