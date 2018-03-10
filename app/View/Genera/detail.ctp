<div class="container-fluid">
    <h2><?php echo __('Edit Genus'); ?></h2>
    <div id="functions-bar" class="row">
        <div class="col-md-1">
            <?php
            $recordBack = !empty($this->request->params['named']['record']) ? $this->request->params['named']['record'] : '';
            if (!empty($recordBack)) {
                echo $this->Html->link('<< Back', array('controller' => 'data', 'action' => 'detail', $this->request->params['named']['record']), array('class' => 'btn btn-primary'));
            }
            ?>
        </div>
        <div class="col-md-1">
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-chevron-up"></span> View all genera', '/genera/index', array('class' => 'btn btn-default', 'escape' => false)); ?>
        </div>
    </div>
    <div id="table-container">
        <table class="table table-striped table-bordered table-condensed table-responsive">
            <tr>
                <th>ID</th>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Authors'); ?></th>
                <th><?php echo __('Vernacular'); ?></th>
                <th><?php echo __('Family APG4'); ?></th>
                <th><?php echo __('Family'); ?></th>
            </tr>
            <tr>
                <td><?php echo Hash::get($result, 'Genus.id'); ?></td>
                <td><?php echo $this->Edit->eipInput($result, 'Genus.name', array('editable' => $authorizedEdit)); ?></td>
                <td><?php echo $this->Edit->eipInput($result, 'Genus.authors', array('editable' => $authorizedEdit)); ?></td>
                <td><?php echo $this->Edit->eipInput($result, 'Genus.vernacular', array('editable' => $authorizedEdit)); ?></td>
                <td>
                    <?php
                    echo $this->Edit->eipInput($result, 'Genus.id_family_apg', array(
                        'editable' => $authorizedEdit,
                        'type' => 'select',
                        'source' => $familiesApg,
                        'display' => Hash::get($result, 'FamilyApg.name'),
                        'viewSelect' => true,
                        'viewUrl' => $this->Html->url(array(
                            'controller' => 'familiesApg',
                            'action' => 'detail',
                            Hash::get($result, 'Genus.id_family_apg'),
                            'genus' => Hash::get($result, 'Genus.id'),
                            'record' => $recordBack
                                )
                    )));
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Edit->eipInput($result, 'Genus.id_family', array(
                        'editable' => $authorizedEdit,
                        'type' => 'select',
                        'source' => $families,
                        'display' => Hash::get($result, 'Family.name'),
                        'viewSelect' => true,
                        'viewUrl' => $this->Html->url(array(
                            'controller' => 'families',
                            'action' => 'detail',
                            Hash::get($result, 'Genus.id_family'),
                            'genus' => Hash::get($result, 'Genus.id'),
                            'record' => $recordBack
                                )
                        )
                    ));
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>