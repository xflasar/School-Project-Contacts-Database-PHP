<?php

function count_persons($db) {
    $stmt = $db->query("SELECT count(*) as persons_count FROM person");
    return $stmt->fetchAll();
};

function count_womens($db) {
    $stmt = $db->query("SELECT count(*) as womens FROM person WHERE gender = 'female'");
    return $stmt->fetchAll();
};

function count_mens($db) {
    $stmt = $db->query("SELECT count(*) as mens FROM person WHERE gender = 'male'");
    return $stmt->fetchAll();
};

function birth_day($db) {
    $stmt = $db->query("SELECT birth_day FROM person WHERE birth_day IS NOT NULL");
    return $stmt->fetchAll();
};

function count_locations($db) {
    $stmt = $db->query("SELECT count(*) as locations_count FROM location");
    return $stmt->fetchAll();
};

function count_foreign_countries($db) {
    $stmt = $db->query("SELECT count(*) FROM location WHERE country !='' AND country != 'Česká Republika' 
                                                                         AND country != 'Česko' 
                                                                         AND country != 'ČR' 
                                                                         AND country != 'Česká republika'
                                                                         AND country != 'ceska republika'
                                                                         AND country != 'česká epublika'
                                                                         AND country != 'čr'
                                                                         AND country != 'česko'");
    return $stmt->fetchAll();
};

function count_contact_types($db, $conType) {
    $stmt = $db->prepare("SELECT count(*) FROM contact WHERE id_contact_type = :conType");	
    $stmt->bindValue(':conType', $conType);
    $stmt->execute();
    return $stmt->fetchAll();
};

function count_all_CT($db) {
    $stmt = $db->query("SELECT count(*) FROM contact");
    return $stmt->fetchAll();
};

function count_relation_types($db, $relType) {
    $stmt = $db->prepare("SELECT count(*) FROM relation WHERE id_relation_type = :relType");	
    $stmt->bindValue(':relType', $relType);
    $stmt->execute();
    return $stmt->fetchAll();
};

function count_all_RT($db) {
    $stmt = $db->query("SELECT count(*) FROM relation");
    return $stmt->fetchAll();
};

function count_meetings($db) {
    $stmt = $db->query("SELECT count(*) FROM meeting");	
    return $stmt->fetchAll();
};

function count_person_meeting($db) {
    $stmt = $db->query("SELECT count(*) FROM person_meeting");	
    return $stmt->fetchAll();
};

function meeting_start($db) {
    $stmt = $db->query("SELECT start FROM meeting");	
    return $stmt->fetchAll();
};