<?php

echo $this->element('record-view-edit', array(
    'result' => $result,
    'list_of_species' => $loss,
    'accepted' => $accepted,
    'genera' => $genera,
    'edit' => true
        )
);
