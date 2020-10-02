<?php

function show_relations($db, $id_person) {
    $stmt = $db->prepare("SELECT * FROM relation
			  LEFT JOIN relation_type ON (relation.id_relation_type = relation_type.id_relation_type)
			  LEFT JOIN person ON (relation.id_person1 = person.id_person) OR (relation.id_person2 = person.id_person)
			  WHERE ((id_person1 = :id_person) OR (id_person2 = :id_person)) AND (id_person != :id_person)
			  ORDER BY name");
    $stmt->bindValue(':id_person', $id_person);
    $stmt->execute();
    return $stmt->fetchAll();
};

function delete_relation($db, $id_relation) {
    $stmt = $db->prepare("DELETE FROM relation WHERE id_relation = :id_relation ");
    $stmt->bindValue(':id_relation', $id_relation);
    $stmt->execute();
    return $stmt->fetchAll();
};

function add_relation($db, $id_person, $formData) {
    $stmt = $db->prepare("INSERT INTO relation
			  (id_relation_type, id_person1, id_person2, description)
			  VALUES (:id_relation_type, :id_person1, :id_person2, :description)");
    $stmt->bindValue(":id_person1", $id_person);
    $stmt->bindValue(":id_person2", $formData['id_person2']);
    $stmt->bindValue(":id_relation_type", $formData['id_relation_type']);
    $stmt->bindValue(":description", empty($formData['description']) ? "" : $formData['description']);
    $stmt->execute();
    return $stmt->fetchAll();
};