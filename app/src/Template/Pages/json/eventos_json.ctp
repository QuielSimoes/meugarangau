<?php
$json = array();
if (count($eventos->getItems()) > 0) {
    foreach ($eventos->getItems() as $event):
        $dtInicio = isset($event->start->dateTime) ? $event->start->dateTime : $event->start->date;
        $objInicio = new \DateTime($dtInicio);
        $evento = array(
            'id' => $event->getId(),
            'title' => $event->getSummary(),
            'start' => $objInicio->format('Y-m-d')
        );
        array_push($json, $evento);
    endforeach;
}
echo json_encode($json);