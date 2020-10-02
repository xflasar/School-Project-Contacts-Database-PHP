<?php

function insert_location($db, $formData) {
    try {
        $stmt = $db->prepare("INSERT INTO location
        		     (street_name, city, street_number, zip)
        		     VALUES (:street_name, :city, :street_number, :zip)");
        $stmt->bindValue(":street_name", empty($formData['street_name']) ? null : $formData['street_name']);
        $stmt->bindValue(":city", empty($formData['city']) ? null : $formData['city']);
        $stmt->bindValue(":street_number", empty($formData['street_number']) ? null : $formData['street_number']);
        $stmt->bindValue(":zip", empty($formData['zip']) ? null : $formData['zip']);
        $stmt->execute();
        return $db->lastInsertId('location_id_location_seq');
    } catch (PDOException $e) {
        echo $e->getMessage();
	return false;
    }
};

function delete_location($db, $id_location) {
    $stmt = $db->prepare("DELETE FROM location WHERE id_location = :id_location");
    $stmt->bindValue(":id_location", $id_location);
    $stmt->execute();
    return true;                               
};

function show_all_locations($db) {
	$stmt = $db->query("SELECT * FROM location ORDER BY city");
	return $stmt->fetchAll();
};