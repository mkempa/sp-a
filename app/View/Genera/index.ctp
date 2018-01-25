
<div class="container-fluid">
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
                <th></th>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Authors'); ?></th>
                <th><?php echo __('Vernacular'); ?></th>
                <th><?php echo __('Family APG4'); ?></th>
                <th><?php echo __('Family'); ?></th>
            </tr>

            <?php
            foreach ($data as $d) :
                $active = '';
                if (!empty($this->params['pass'])) {
                    $active = $this->Format->checkClass(Hash::get($d, 'Genus.id'), $this->params['pass'][0], 'emph');
                }
                ?>
                <tr class="<?php echo $active; ?>">
                    <td><?php echo Hash::get($d, 'Genus.id'); ?></td>
                    <td><?php echo!empty($active) ? $this->Html->link('Back', $back, array('class' => 'btn btn-default btn-xs')) : ''; //if the row is emphasized, provide back button  ?></td>
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
                                'action' => 'index',
                                'id' => Hash::get($d, 'Genus.id_family_apg'),
                                'parent' => Hash::get($d, 'Genus.id')
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
                            'viewUrl' => $this->Html->url("/families/index/" . Hash::get($d, 'Genus.id_family'))
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