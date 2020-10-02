<?php

include 'location.php';

function show_person($db, $id_person) {
    $stmt = $db->prepare("SELECT * FROM person WHERE person.id_person = :id_person");
    $stmt->bindValue(':id_person', $id_person);
    $stmt->execute();
    return $stmt->fetchAll();
}

function person_info($db, $id_person) {
    $stmt = $db->prepare("SELECT contact_type.name as contact_name, location.name as location_name, person.id_person as personal_id, * FROM person 
				    LEFT JOIN location ON (person.id_location = location.id_location) 
				    LEFT JOIN contact ON (person.id_person = contact.id_person)
				    LEFT JOIN contact_type ON (contact.id_contact_type = contact_type.id_contact_type)
				    WHERE person.id_person = :id_person");
    $stmt->bindValue(':id_person', $id_person);
    $stmt->execute();
    return $stmt->fetch();                               
}

function show_all_persons($db) {
    $stmt = $db->query("SELECT * FROM person LEFT JOIN location ON (person.id_location = location.id_location) ORDER BY first_name");
    return $stmt->fetchAll();
}

function show_all_persons_except_one($db, $id_person) {
            $stmt = $db->prepare("SELECT * FROM person WHERE id_person != :id_person ORDER BY first_name ");
            $stmt->bindValue(':id_person', $id_person);
            $stmt->execute();
            return $stmt->fetchAll();
}

function insert_person($db, $formData) {
    try {
        /* vlozeni adresy - musi se provest pred vlozenim osoby */
        if (!empty($formData['city']) || !empty($formData['street_name'])) {
            $id_location = insert_location($db, $formData);
        } else {
            $id_location = null;
        }
        /* vlozeni osoby */
        $stmt = $db->prepare("INSERT INTO person
            (nickname, first_name, last_name, id_location, birth_day, height, gender)
            VALUES (:nickname, :first_name, :last_name, :id_location, :birth_day, :height, :gender)");
            $stmt->bindValue(":nickname", $formData['nickname']);
            $stmt->bindValue(":last_name", $formData['last_name']);
            $stmt->bindValue(":first_name", $formData['first_name']);
            $stmt->bindValue(":id_location", $id_location ? $id_location : null);
            $stmt->bindValue(":gender", empty($formData['gender']) ? null : $formData['gender']);
            $stmt->bindValue(":height", empty($formData['height']) ? null : $formData['height']);
            $stmt->bindValue(":birth_day", empty($formData['birth_day']) ? null : $formData['birth_day']);
            $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
};

function delete_person($db, $id_person) {
    $stmt = $db->prepare("DELETE FROM person WHERE id_person = :id_person");
    $stmt->bindValue(":id_person", $id_person);
    $stmt->execute();
    return true;                               
};


