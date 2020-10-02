<?php

function show_contacts($db, $id_person) {
    $stmt = $db->prepare("SELECT * FROM person 
			  RIGHT JOIN contact ON (contact.id_person = person.id_person)  
			  LEFT JOIN contact_type ON (contact.id_contact_type = contact_type.id_contact_type) 
			  WHERE person.id_person = :id_person
			  ORDER BY name");
    $stmt->bindValue(':id_person', $id_person);
    $stmt->execute();
    return $stmt->fetchAll();
};

function delete_contact($db, $id_contact) {
    $stmt = $db->prepare("DELETE FROM contact WHERE id_contact = :id_contact");
    $stmt->bindValue(':id_contact', $id_contact);
    $stmt->execute();
    return $stmt->fetchAll();
};

function add_contacts($db, $id_person, $formData) {
    $stmt = $db->prepare("INSERT INTO contact
			  (id_contact_type, contact, id_person)
			  VALUES (:id_contact_type, :contact, :id_person)");
    $stmt->bindValue(":id_person", $id_person);
    $stmt->bindValue(":id_contact_type", $formData['id_contact_type']);
    $stmt->bindValue(":contact", $formData['contact']);
    $stmt->execute();
    return $stmt->fetchAll();
};

