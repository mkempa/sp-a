<?php
//new dBug($data);
?>

<div class="container-fluid">
    <h2><?php echo __('Family'); ?></h2>
    <div id="table-container">
        <table class="table table-striped table-bordered table-condensed table-responsive">
            <tr>
                <th class="col-xs-1"><?php echo __('ID'); ?></th>
                <th class="col-xs-5"><?php echo __('Name'); ?></th>
                <th class="col-xs-5"><?php echo __('Vernacular'); ?></th>
            </tr>

            <?php foreach ($data as $d) : ?>
                <tr>
                    <td><?php echo Hash::get($d, 'Family.id'); ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'Family.name', array('editable' => $authorizedEdit)); ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'Family.vernacular', array('editable' => $authorizedEdit)); ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    </div>
</div>