<?php
//new dBug($synonyms);
$synonyms_list = Hash::combine($synonyms, '{n}.Nomenclature.id', '{n}');
unset($synonyms);

foreach ($synonyms_list as $key => $val) {
    $l = $this->Format->los($val['Nomenclature']);
    $synonyms_list[$key] = $l;
}

asort($synonyms_list);
echo $this->Form->hidden('synonyms', array('id' => 'synonyms-list', 'value' => json_encode(array_values($synonyms_list))));
?>
<div id="checklist-edit" class="container">
    <h4>Nomenclatoric Synonyms</h4>
    <ul id="synonyms-nomenclatoric" class="list-group addable">
        <?php if (empty($nomenclatoric)): ?>
            <li class="list-group-item"></li>
            <?php
        endif;
        foreach ($nomenclatoric as $n):
            ?>
            <li class="list-group-item">
                <span>&#8801;</span>
                <?php echo $this->Format->los($n['SynonymSpecies'], array('special' => $n['SynonymSpecies']['is_isonym'])); ?>
                <span class="pull-right">
                    <?php
                    $id = $n['Synonym']['id'];
                    echo $this->Html->link('<span class="glyphicon glyphicon-share-alt"></span> =', array('controller' => 'synonyms', 'action' => 'totaxonomic', $id, $parentId), array(
                        'class' => 'btn btn-default btn-xs', 
                        'title' => 'Make this a taxonomic synonym',
                        'escape' => false)); 
                    echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'synonyms', 'action' => 'remove', $id, $parentId), array(
                        'class' => 'btn btn-danger btn-xs', 
                        'title' => 'Remove',
                        'escape' => false
                    ));
                    ?>
                </span>
            </li>
        <?php endforeach; ?>
        <li class="list-group-item">
            <button id="synonyms-nomenclatoric-add" class="btn btn-success btn-sm add-row-btn" data-url="<?php echo $this->Html->url(array('controller' => 'synonyms', 'action' => 'add', 'nomenclatoric', $parentId)); ?>"><span class="glyphicon glyphicon-plus"></span></button>
        </li>
    </ul>
    
    <h4>Taxonomic Synonyms</h4>
    <ul id="synonyms-taxonomic" class="list-group addable">
        <?php if (empty($taxonomic)): ?>
            <li class="list-group-item"></li>
            <?php
        endif;
        foreach ($taxonomic as $t):
            ?>
            <li class="list-group-item">
                <span>=</span>
                <?php echo $this->Format->los($t['SynonymSpecies'], array('special' => $t['SynonymSpecies']['is_isonym'])); ?>
                <span class="pull-right">
                    <?php
                    $id = $t['Synonym']['id'];
                    echo $this->Html->link('<span class="glyphicon glyphicon-share-alt"></span> &#8801;', array('controller' => 'synonyms', 'action' => 'tonomenclatoric', $id, $parentId), array(
                        'class' => 'btn btn-default btn-xs', 
                        'title' => 'Make this a nomenclatoric synonym',
                        'escape' => false)); 
                    echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array('controller' => 'synonyms', 'action' => 'remove', $id, $parentId), array(
                        'class' => 'btn btn-danger btn-xs', 
                        'title' => 'Remove',
                        'escape' => false
                    ));
                    ?>
                </span>
            </li>
        <?php endforeach; ?>
        <li class="list-group-item">
            <button id="synonyms-taxonomic-add" class="btn btn-success btn-sm add-row-btn" data-url="<?php echo $this->Html->url(array('controller' => 'synonyms', 'action' => 'add', 'taxonomic', $parentId)); ?>"><span class="glyphicon glyphicon-plus"></span></button>
        </li>
    </ul>
</div>