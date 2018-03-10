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

$loss_list = Hash::combine($list_of_species, '{n}.Nomenclature.id', '{n}');
unset($list_of_species);

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

    <?php
    if ($edit === false) {
        echo '<h3>' . __('New name') . '</h3>';
        echo $this->Form->create('Family', array('type' => 'post', 'url' => array('controller' => 'data', 'action' => 'add'),
            'id' => 'DataAddForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
    } else {
        echo '<h3>' . __('Name') . '</h3>';
    }
    ?>

    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Family APG-4'); ?></td>
            <td><?php echo Hash::get($result, 'Genus.FamilyApg.name'); ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Family'); ?></td>
            <td><?php echo Hash::get($result, 'Genus.Family.name'); ?></td>
        </tr>
    </table>

    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Genus'); ?></td>
            <td><?php
                echo $this->Edit->eipInput($result, 'Nomenclature.id_genus', array(
                    'editable' => $authorizedEdit,
                    'type' => 'select',
                    'source' => $genera,
                    'display' => Hash::get($result, 'Genus.name'),
                    'viewSelect' => true,
                    'viewUrl' => $this->Html->url(array(
                        'controller' => 'genera',
                        'action' => 'detail',
                        Hash::get($result, 'Nomenclature.id_genus'),
                        'record' => Hash::get($result, 'Nomenclature.id')))
                        ), $edit);
                ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Genus text'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.genus', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Species'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.species', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Subsp'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.subsp', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Var'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.var', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Subvar'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.subvar', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Forma'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.forma', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Authors'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.authors', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Type'); ?></td>
            <td>
                <?php
                echo $this->Edit->eipInput($result, 'Nomenclature.ntype', array('editable' => $authorizedEdit,
                    'type' => 'select',
                    'source' => $ntypes,
                    'display' => $this->Format->type(Hash::get($result, 'Nomenclature.ntype'))), $edit);
                ?> 
            </td>
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
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.genus_h', array('editable' => $authorizedEdit), $edit); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Species'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.species_h', array('editable' => $authorizedEdit), $edit); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Subsp'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.subsp_h', array('editable' => $authorizedEdit), $edit); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Var'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.var_h', array('editable' => $authorizedEdit), $edit); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Subvar'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.subvar_h', array('editable' => $authorizedEdit), $edit); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Forma'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.forma_h', array('editable' => $authorizedEdit), $edit); ?> </td>
                    </tr>
                    <tr>
                        <td class="col-xs-4"><?php echo __('H. Authors'); ?></td>
                        <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.authors_h', array('editable' => $authorizedEdit), $edit); ?> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Publication'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.publication', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Tribus'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'Nomenclature.tribus', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Is isonym'); ?></td>
            <td>
                <?php
                echo $this->Edit->eipInput($result, 'Nomenclature.is_isonym', array(
                    'editable' => $authorizedEdit,
                    'isBool' => true,
                    'valTrue' => 'True',
                    'valFalse' => 'False'), $edit);
                ?>
            </td>
        </tr>
    </table>

    <h3><?php echo __('Status'); ?></h3>
    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Allochthonous'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'NomenStatus.allochthonous', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Invasiveness'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'NomenStatus.invasiveness', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Cultivation'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'NomenStatus.cultivation', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Protection'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'NomenStatus.protection', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Endemism'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'NomenStatus.endemism', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Doubtfullness'); ?></td>
            <td><?php echo $this->Edit->eipInput($result, 'NomenStatus.doubtfullness', array('editable' => $authorizedEdit), $edit); ?> </td>
        </tr>
    </table>

    <h3><?php echo __('Associations'); ?></h3>
    <table class="table table-bordered table-condensed table-responsive">
        <tr>
            <td class="col-xs-4"><?php echo __('Accepted name'); ?></td>
            <td><?php
                echo $this->Edit->eipInput($result, 'Nomenclature.id_accepted_name', array(
                    'editable' => $authorizedEdit,
                    'type' => 'select',
                    'source' => $accepted_list,
                    'display' => $this->Format->los(Hash::get($result, 'Accepted')),
                    'viewSelect' => true,
                    'viewUrl' => $this->Html->url("/data/detail/" . Hash::get($result, 'Accepted.id'))
                        ), $edit);
                ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Basionym'); ?></td>
            <td><?php
                echo $this->Edit->eipInput($result, 'Nomenclature.id_basionym', array(
                    'editable' => $authorizedEdit,
                    'type' => 'select',
                    'source' => $loss_list,
                    'display' => $this->Format->los(Hash::get($result, 'Basionym')),
                    'viewSelect' => true,
                    'viewUrl' => $this->Html->url("/data/detail/" . Hash::get($result, 'Nomenclature.id_basionym'))
                        ), $edit);
                ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Replaced name'); ?></td>
            <td><?php
                echo $this->Edit->eipInput($result, 'Nomenclature.id_replaced', array(
                    'editable' => $authorizedEdit,
                    'type' => 'select',
                    'source' => $loss_list,
                    'display' => $this->Format->los(Hash::get($result, 'Replaced')),
                    'viewSelect' => true,
                    'viewUrl' => $this->Html->url("/data/detail/" . Hash::get($result, 'Nomenclature.id_replaced'))
                        ), $edit);
                ?></td>
        </tr>
        <tr>
            <td class="col-xs-4"><?php echo __('Nomen novum'); ?></td>
            <td><?php
                echo $this->Edit->eipInput($result, 'Nomenclature.id_nomen_novum', array(
                    'editable' => $authorizedEdit,
                    'type' => 'select',
                    'source' => $loss_list,
                    'display' => $this->Format->los(Hash::get($result, 'NomenNovum')),
                    'viewSelect' => true,
                    'viewUrl' => $this->Html->url("/data/detail/" . Hash::get($result, 'Nomenclature.id_nomen_novum'))
                        ), $edit);
                ?></td>
        </tr>
    </table>

    <?php
    if ($edit === true) {
        echo $this->element('synonyms-view', array('result' => $result));
    }
    ?>


    <?php if ($edit === false): ?>
        <div class="row submit-panel">
            <div class="col-md-1 col-xs-6">
                <?php
                echo $this->Form->submit('Save', array(
                    'class' => 'btn btn-primary'
                ));
                ?>
            </div>
            <div class="col-md-1 col-xs-6">
                <?php
                echo $this->Html->link(__('Cancel'), '/families/index', array(
                    'class' => 'btn btn-default'
                ));
                ?>
            </div>
        </div>
        <?php $this->Form->end(); ?>
    <?php else: ?>
        <div class="col-xs-6"><?php echo $this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn btn-default')); ?></div>
    <?php endif; ?>
</div>