
<div class="container-fluid">
    <h2><?php echo __('Genera'); ?></h2>
    <div id="functions-bar" class="row">
        <div class="col-md-1">
            <?php
            $span = '<span class="glyphicon glyphicon-plus"></span>';
            echo $this->Html->link("$span add", '/genera/add', array('class' => 'btn btn-success btn-sm', 'escape' => false));
            ?>
        </div>
    </div>

    <div class="row text-center text-primary">
        <?php
        echo $this->Paginator->counter(
                'Page {:page} of {:pages}, showing {:current} records out of
     			{:count} total'
        );
        ?>
    </div>
    <div class="row text-center">
        <ul class="pagination">
            <?php echo $this->Paginator->prev('< Prev', array('tag' => 'li', 'class' => false), null, array('disabledTag' => 'a', 'class' => 'disabled')); ?>
            <?php echo $this->Paginator->numbers(array('first' => 1, 'last' => 1, 'modulus' => 6, 'tag' => 'li', 'separator' => false, 'ellipsis' => '<li class="readonly"><a>...</a></li>', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
            <?php echo $this->Paginator->next('Next >', array('tag' => 'li', 'class' => false), null, array('disabledTag' => 'a', 'class' => 'disabled')); ?>
        </ul>
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

            <?php foreach ($data as $d) : ?>
                <tr>
                    <td><?php echo Hash::get($d, 'Genus.id'); ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'Genus.name', array('editable' => $authorizedEdit)); ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'Genus.authors', array('editable' => $authorizedEdit)); ?></td>
                    <td><?php echo $this->Edit->eipInput($d, 'Genus.vernacular', array('editable' => $authorizedEdit)); ?></td>
                    <td><?php
                        echo $this->Edit->eipInput($d, 'Genus.id_family_apg', array(
                            'editable' => $authorizedEdit,
                            'type' => 'select',
                            'source' => $familiesApg,
                            'display' => Hash::get($d, 'FamilyApg.name'),
                            'viewSelect' => true,
                            'viewUrl' => $this->Html->url(array(
                                'controller' => 'familiesApg',
                                'action' => 'detail',
                                Hash::get($d, 'Genus.id_family_apg')
                                    )
                        )));
                        ?></td>
                    <td><?php
                        echo $this->Edit->eipInput($d, 'Genus.id_family', array(
                            'editable' => $authorizedEdit,
                            'type' => 'select',
                            'source' => $families,
                            'display' => Hash::get($d, 'Family.name'),
                            'viewSelect' => true,
                            'viewUrl' => $this->Html->url(array(
                                'controller' => 'families',
                                'action' => 'detail',
                                Hash::get($d, 'Genus.id_family')
                                    )
                            )
                        ));
                        ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    </div>

    <div class="row text-center">
        <ul class="pagination">
            <?php echo $this->Paginator->prev('< Prev', array('tag' => 'li', 'class' => false), null, array('disabledTag' => 'a', 'class' => 'disabled')); ?>
            <?php echo $this->Paginator->numbers(array('first' => 1, 'last' => 1, 'modulus' => 6, 'tag' => 'li', 'separator' => false, 'ellipsis' => '<li class="readonly"><a>...</a></li>', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
            <?php echo $this->Paginator->next('Next >', array('tag' => 'li', 'class' => false), null, array('disabledTag' => 'a', 'class' => 'disabled')); ?>
        </ul>
    </div>
</div>