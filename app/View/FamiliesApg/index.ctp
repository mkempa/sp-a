<?php
//new dBug($data);
?>

<div class="container-fluid">
    <h2><?php echo __('Family APG4'); ?></h2>
    <div id="table-container">
        <table class="table table-striped table-bordered table-condensed table-responsive">
            <tr>
                <th class="col-xs-1"><?php echo __('ID'); ?></th>
                <th class="col-xs-1"></th>
                <th class="col-xs-5"><?php echo __('Name'); ?></th>
                <th class="col-xs-5"><?php echo __('Vernacular'); ?></th>
            </tr>

            <?php foreach ($data as $d) :
                $active = '';
                if (!empty($this->params['named'])) {
                    $active = $this->Format->checkClass(Hash::get($d, 'FamilyApg.id'), $this->params['named']['id'], 'emph');
                }
                ?>
                <tr class="<?php echo $active; ?>">
                    <td><?php echo Hash::get($d, 'FamilyApg.id'); ?></td>
                    <td><?php echo !empty($active) ? $this->Html->link('Back', array('controller' => 'genera', 'action' => 'index', 'id' => $parent), array('class' => 'btn btn-default btn-xs')) : ''; //if the row is emphasized, provide back button ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'FamilyApg.name', array('editable' => $authorizedEdit)); ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'FamilyApg.vernacular', array('editable' => $authorizedEdit)); ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    </div>
</div>