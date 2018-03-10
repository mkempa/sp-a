<h3>
    <?php echo __('Nomenclatoric Synonyms'); ?>
    <?php if ($authorizedEdit): ?>
        <small><?php echo __('(Synonyms can be managed only in ') . $this->Html->link('full edit mode', array('action' => 'edit', Hash::get($result, 'Nomenclature.id'))) . ')'; ?></small>
    <?php endif; ?>
</h3>
<table class="table table-condensed table-responsive table-bordered">
    <?php if (empty($result['SynonymsNomenclatoric'])): //show one empty row    ?>
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
    <?php if ($authorizedEdit): ?>
        <small><?php echo __('(Synonyms can be managed only in ') . $this->Html->link('full edit mode', array('action' => 'edit', Hash::get($result, 'Nomenclature.id'))) . ')'; ?></small>
    <?php endif; ?>
</h3>
<p>
    All associated nomenclatoric synonyms are shown here to see which are associated with each other. Those in grey colour will not be shown on the website.
    <?php echo $this->Html->link('(Example)', '/checklist/detail/335'); ?>
</p>
<table class="table table-condensed table-responsive table-bordered">
    <?php if (empty($result['SynonymsTaxonomic'])): //show one empty row    ?>
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
    <?php if (empty($result['SynonymsInvalid'])): //show one empty row    ?>
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
    <?php if (empty($result['BasionymFor'])): //show one empty row    ?>
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
    <?php if (empty($result['ReplacedFor'])): //show one empty row    ?>
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