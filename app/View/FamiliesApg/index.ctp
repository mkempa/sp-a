<?php
//new dBug($data);
?>

<div class="container-fluid">
    <h2><?php echo __('Family APG4'); ?></h2>
    <div id="functions-bar" class="row">
        <?php if ($authorizedEdit): ?>
            <div class="col-md-1">
                <?php
                $span = '<span class="glyphicon glyphicon-plus"></span>';
                echo $this->Html->link("$span add", '/familiesApg/add', array('class' => 'btn btn-success btn-sm', 'escape' => false));
                ?>
            </div>
        <?php endif; ?>
    </div>
    <div id="table-container">
        <table class="table table-striped table-bordered table-condensed table-responsive">
            <tr>
                <th class="col-xs-1"><?php echo __('ID'); ?></th>
                <th class="col-xs-5"><?php echo __('Name'); ?></th>
                <th class="col-xs-5"><?php echo __('Vernacular'); ?></th>
            </tr>

            <?php foreach ($data as $d) : ?>
                <tr>
                    <td><?php echo Hash::get($d, 'FamilyApg.id'); ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'FamilyApg.name', array('editable' => $authorizedEdit)); ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'FamilyApg.vernacular', array('editable' => $authorizedEdit)); ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    </div>
</div>