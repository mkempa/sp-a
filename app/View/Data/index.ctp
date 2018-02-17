<?php
//new dBug($data[0]);
?>
<div id="functions" class="container well">
    <div class="row">
        <div class="col-xs-12">
            <?php
            //$glyph = '<span class="glyphicon glyphicon-plus"></span> ';
            //echo $this->Html->link($glyph . __('Add new'), array('action' => 'insert'), array('class' => 'btn btn-success', 'escape' => false));
            ?>
        </div>
    </div>
    <div class="row">
        <?php 
        $filter = isset($filter) ? $filter : 1;
        echo $this->element('view-filter', array('filterrecords' => $filterrecords)); 
        ?>
    </div>
</div>

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
                <th><?php echo __('Action'); ?></th>
                <th><?php echo __('Type'); ?></th>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Publication'); ?></th>
                <th><?php echo __('Accepted name'); ?></th>
            </tr>

            <?php
            foreach ($data as $d) :
                $is_isonym = Hash::get($d, 'is_isonym');
                ?>
                <tr>
                    <td><?php echo $this->Html->link($d['Nomenclature']['id'], array('action' => 'detail', $d['Nomenclature']['id']), array('title' => __('View'))); ?></td>
                    <td><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $d['Nomenclature']['id']), array('title' => __('Edit'))); ?></td>
                    <td><?php echo Hash::get($d, 'Nomenclature.ntype', '-'); ?></td>
                    <td><?php
                        $name = $this->Format->los(Hash::get($d, 'Nomenclature'), array('publication' => false, 'special' => $is_isonym));
                        echo $this->Html->link($name, array('action' => 'detail', $d['Nomenclature']['id']), array('title' => __('View')));
                        ?>
                    </td>
                    <td><?php echo Hash::get($d, 'Nomenclature.publication'); ?></td>
                    <td><?php
                        $a_name = $this->Format->los(Hash::get($d, 'Accepted'), array('publication' => false, 'special' => $is_isonym));
                        echo $a_name ? $this->Html->link($a_name, array('action' => 'detail', Hash::get($d, 'Accepted.id'))) : '';
                        ?>
                    </td>
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