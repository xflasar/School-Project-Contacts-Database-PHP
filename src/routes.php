<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include 'person.php';
include 'contact.php';
include 'relation.php';
include 'database.php';

$app->get('/', function (Request $request, Response $response, $args) {
    $stmt = $this->db->query('SELECT * FROM person LEFT JOIN location ON (person.id_location = location.id_location) ORDER BY first_name');  

    $tplVars['date'] = date("Y/m/d");
    $tplVars['osoby'] = $stmt->fetchAll();
    $tplVars['routeName'] = 'persons';
    return $this->view->render($response, 'index.latte', $tplVars);
})->setName('index');

$app->get('/profile', function(Request $request, Response $response, $args){
    $params = $request->getQueryParams();

    $tplVars['date'] = date("Y/m/d");
        $tplVars['contacts'] = show_contacts($this->db, $params['id_person']);
      	$tplVars['relations'] = show_relations($this->db, $params['id_person']);
      	$tplVars['id_person'] = $params['id_person'];
        $tplVars['info'] = person_info($this->db, $params['id_person']);
        if (empty($tplVars['info'])){
           	$tplVars['message'] = "ERROR!";  
            return $this->view->render($response, 'error.latte', $tplVars);
        } else {
            return $this->view->render($response, 'profileMain.latte', $tplVars);
        }
})->setName('profile');

$app->get('/new', function (Request $request, Response $response, $args) {
     $tplVars['formData'] = [            
     'first_name' => '',
     'last_name' => '',
     'nickname' => '',
     'id_location' => null,
     'gender' => '',
     'height' => '',
     'birth_day' => '',
     'city' => '',
     'street_number' => '',
     'street_name' => '',
     'zip' => ''
     ];
     $tplVars['message'] = '* Please fill all required fields';  
     return $this->view->render($response, 'NewPerson.latte', $tplVars);
})->setName('NewPerson');

$app->post('/new', function (Request $request, Response $response, $args) {
     $formData = $request->getParsedBody();
     if (empty($formData['first_name']) || empty($formData['last_name']) || empty($formData['nickname'])) {
        $tplVars['message'] = "Please fill required fields";
     } else {
        try  {
            insert_person($this->db, $formData);
            $tplVars['message'] = "Person succefully added!";
          	$tplVars['osoby'] = show_all_persons($this->db);
          	$tplVars['date'] = date("Y/m/d");
        } catch (PDOException $e) {
           	$tplVars['message'] = "ERROR!";  
            $tplVars['err'] = "Error detail: " . $e->getMessage();
            return $this->view->render($response, 'error.latte', $tplVars);
        }
     }
     $tplVars['formData'] = $formData;
     return $this->view->render($response, 'index.latte', $tplVars);
});

// This is for updating existing person
$app->get('/update', function (Request $request, Response $response, $args) {  
    $params = $request->getQueryParams();  
    if (empty($params['id_person'])){
       	$tplVars['message'] = "ERROR!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    } else {
        $stmt = $this->db->prepare("SELECT * FROM person LEFT JOIN location ON (person.id_location = location.id_location) WHERE id_person = :id_person");
        $stmt->bindValue(':id_person', $params['id_person']);
        $stmt->execute();
        $tplVars ['formData'] = $stmt->fetch();
        if (empty($tplVars['formData'])){
           	$tplVars['message'] = "ERROR!";  
            return $this->view->render($response, 'error.latte', $tplVars);
        } else {
          	$tplVars['id_person'] = $params['id_person'];
          	$tplVars['date'] = date("Y/m/d");
            $tplVars['message'] = '* Required fields';
            return $this->view->render($response, 'UpdateExistingPerson.latte', $tplVars);
        }         
    }
})->setName('person_Update');

$app->post('/update', function (Request $request, Response $response, $args) {
    $formData = $request->getParsedBody();
    $id_person = $request->getQueryParam('id_person');
     if (empty($formData['first_name']) || empty($formData['last_name']) || empty($formData['nickname']) || empty($id_person)) {
        $tplVars['message'] = "Please fill required fields";
    } else {
        try {
	          $stmt = $this->db->prepare("UPDATE person SET
                                first_name = :fn,
                                last_name = :ln,
                                nickname = :nn,
                                birth_day = :bd,
                                gender = :gn,
                                height = :hg
                                WHERE id_person = :idp");
            $stmt->bindValue(":fn", $formData['first_name']);
            $stmt->bindValue(":ln", $formData['last_name']);
            $stmt->bindValue(":nn", $formData['nickname']);
            $stmt->bindValue(":gn", empty($formData['gender']) ? null : $formData['gender']);
            $stmt->bindValue(":hg", empty($formData['height']) ? null : $formData['height']);
            $stmt->bindValue(":bd", empty($formData['birth_day']) ? null : $formData['birth_day']);
            $stmt->bindValue(":idp", $id_person);
            $stmt->execute();
       	    $tplVars['message'] = "Person succefully updated!";
      	    $tplVars['date'] = date("Y/m/d");
      	    $tplVars['id_person'] = $id_person;
        } catch (PDOexception $e) {
           	$tplVars['message'] = "ERROR!";
            $tplVars['err'] = "Error detail: " . $e->getMessage();  
            return $this->view->render($response, 'error.latte', $tplVars);
        }
    }    
    $tplVars['formData'] = $formData;
    return $this->view->render($response, 'UpdateExistingPerson.latte', $tplVars);
});

$app->get('/delete', function (Request $request, Response $response, $args) { 
    $id_person = $request->getQueryParam('id_person'); 
    if (!empty($id_person)) {
        try {
            delete_person($this->db, $id_person);
        } catch (PDOexception $e) {
           	$tplVars['message'] = "ERROR!"; 
            $tplVars['err'] = "Error detail: " . $e->getMessage(); 
            return $this->view->render($response, 'error.latte', $tplVars);
        }
    } else {
       	$tplVars['message'] = "ERROR!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    }
    return $response->withHeader('Location', $this->router->pathFor('index'));
})->setName ('person_Delete');

$app->get('/detach_location', function (Request $request, Response $response, $args) { 
    $params = $request->getQueryParams();
    $stmt = $this->db->prepare("UPDATE person SET id_location = null WHERE id_person = :id_person");
    $stmt->bindValue(':id_person', $params['id_person']);
    $stmt->execute();
    $tplVars['message'] = 'Location detached';
    $tplVars['date'] = date("Y/m/d");
    $tplVars['contacts'] = show_contacts($this->db, $params['id_person']);
    $tplVars['relations'] = show_relations($this->db, $params['id_person']);
    $tplVars['id_person'] = $params['id_person'];
    $tplVars['info'] = person_info($this->db, $params['id_person']);
    //return $this->view->render($response, 'profileMain.latte', $tplVars);
    return $response->withHeader('Location', $this->router->pathFor('profile') . '?id_person=' . $params['id_person'] );
})->setName ('detach_Location');

$app->get('/info', function (Request $request, Response $response, $args) {  
    $params = $request->getQueryParams();  
    if (empty($params['id_person'])){
       	$tplVars['message'] = "Error: id_person is missing";  
        return $this->view->render($response, 'error.latte', $tplVars);
    } else {
        $tplVars['date'] = date("Y/m/d");
        $tplVars['contacts'] = show_contacts($this->db, $params['id_person']);
      	$tplVars['relations'] = show_relations($this->db, $params['id_person']);
      	$tplVars['id_person'] = $params['id_person'];
        $tplVars['info'] = person_info($this->db, $params['id_person']);
        if (empty($tplVars['info'])){
           	$tplVars['message'] = "ERROR!";  
            return $this->view->render($response, 'error.latte', $tplVars);
        } else {
            return $this->view->render($response, 'profileMain.latte', $tplVars);
        }         
    }
})->setName('person_Info');


// Stuff
$app->get('/attachlocation', function (Request $request, Response $response, $args) {
    $params = $request->getQueryParams();
    $tplVars['info'] = person_info($this->db, $params['id_person']);
    $tplVars['date'] = date("Y/m/d");
    $tplVars['locations'] = show_all_locations($this->db);
    $tplVars['id_person'] = $params['id_person'];                  
    return $this->view->render($response, 'LocationAttach.latte', $tplVars);                                                                             
})->setName('attach_Location');

$app->post('/attachlocation', function (Request $request, Response $response, $args) {
    $formData = $request->getParsedBody();
    $params = $request->getQueryParams();  
    try {
        $stmt = $this->db->prepare("UPDATE person SET id_location = :id_location WHERE id_person = :id_person");
        $stmt->bindValue(':id_location', $formData['id_location']);
        $stmt->bindValue(':id_person', $formData['id_person']);
        $stmt->execute();
    } catch (PDOException $e) {
       	$tplVars['message'] = "ERROR!";
        $tplVars['err'] = "Error detail: " . $e->getMessage();  
        return $this->view->render($response, 'error.latte', $tplVars);
    }       
    $tplVars['date'] = date("Y/m/d");
    $tplVars['contacts'] = show_contacts($this->db, $params['id_person']);
    $tplVars['relations'] = show_relations($this->db, $params['id_person']);
    $tplVars['id_person'] = $params['id_person'];
    $tplVars['message'] = "Location successfully attached!";
    $tplVars['info'] = person_info($this->db, $params['id_person']);
    $tplVars['formData'] = $formData;
return $response->withHeader('Location', $this->router->pathFor('profile') . '?id_person=' . $params['id_person'] );                                                                      
});

$app->get('/locations', function (Request $request, Response $response, $args) {
    $stmt = $this->db->prepare('SELECT * FROM location ORDER BY city');
    $stmt->execute(); 
    $tplVars['routeName'] = 'locations';
    $tplVars['city'] = $stmt->fetchAll();
    return $this->view->render($response, 'Locations.latte', $tplVars);
})->setName('locations');        

$app->get('/locations/info', function (Request $request, Response $response, $args) {  
    $params = $request->getQueryParams();
    $tplVars['id_location'] = $params['id_location'];
    if (empty($params['id_location'])){
       	$tplVars['message'] = "ERROR!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    } else {
        $stmt = $this->db->prepare("SELECT location.id_location as alias_id_location, * FROM location
				    LEFT JOIN meeting ON (location.id_location = meeting.id_location)
				    WHERE location.id_location = :id_location") ;
        $stmt->bindValue(':id_location', $params['id_location']);
        $stmt->execute();
        $tplVars ['info'] = $stmt->fetch();
        if (empty($tplVars['info'])){
           	$tplVars['message'] = "ERROR!";  
            return $this->view->render($response, 'error.latte', $tplVars);
        } else {
            return $this->view->render($response, 'LocationInfo.latte', $tplVars);
        }         
    }
})->setName('location_Info');

$app->get('/locations/new', function (Request $request, Response $response, $args) {
     $tplVars['formData'] = [            
     'country' => '',
     'city' => '',
     'zip' => '',
     'street_name' => '',
     'street_number' => '',
     'name' => '',
     'latitude' => '',
     'longitude' => '',
     'id_location' => null,
     ];  
     $tplVars['id_location'] = "";
     return $this->view->render($response, 'NewLocation.latte', $tplVars);
})->setName('new_Location');

$app->post('/locations/new', function (Request $request, Response $response, $args) {
     $formData = $request->getParsedBody();
     try {
            $stmt = $this->db->prepare("INSERT INTO location 
            (country, city, zip, street_name, street_number, name, latitude, longitude)
            VALUES (:country, :city, :zip, :street_name, :street_number, :name, :latitude, :longitude)");
            $stmt->bindValue(":country", empty($formData['country']) ? null : $formData['country']); 
            $stmt->bindValue(":city", empty($formData['city']) ? null : $formData['city']);
            $stmt->bindValue(":zip", empty($formData['zip']) ? null : $formData['zip']);
            $stmt->bindValue(":street_name", empty($formData['street_name']) ? null : $formData['street_name']);
            $stmt->bindValue(":street_number", empty($formData['street_number']) ? null : $formData['street_number']);
            $stmt->bindValue(":name", empty($formData['name']) ? null : $formData['name']);
            $stmt->bindValue(":latitude", empty($formData['latitude']) ? null : $formData['latitude']);
            $stmt->bindValue(":longitude", empty($formData['longitude']) ? null : $formData['longitude']);
            $stmt->execute();
	          $tplVars['success'] = "true";
            $tplVars['message'] = "Location succefully added!";           
     } catch (PDOException $e) {
           	$tplVars['message'] = "ERROR!";
            $tplVars['err'] = "Error detail: " . $e->getMessage();  
            return $this->view->render($response, 'error.latte', $tplVars);
     }
     $tplVars['formData'] = $formData;
     $tplVars['id_location'] = "";
     return $this->view->render($response, 'NewLocation.latte', $tplVars);
});

$app->get('/locations/update', function (Request $request, Response $response, $args) {  
    $params = $request->getQueryParams();  
    if (empty($params['id_location'])){
        $tplVars['message'] = "ERROR!";
	      $tplVars['err'] = "Error detail: ID location not founded!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    } else {
        $stmt = $this->db->prepare("SELECT * FROM location WHERE id_location = :id_location");
        $stmt->bindValue(':id_location', $params['id_location']);
        $stmt->execute();
        $tplVars['formData'] = $stmt->fetch();
        $tplVars['id_location'] = $params['id_location'];
        if (empty($tplVars['formData'])){
           	$tplVars['message'] = "ERROR!";  
            return $this->view->render($response, 'error.latte', $tplVars);
        } else {
            return $this->view->render($response, 'UpdateLocation.latte', $tplVars);
        }         
    }
})->setName('location_Update');

$app->post('/locations/update', function (Request $request, Response $response, $args) {
    $formData = $request->getParsedBody();
    $id_location = $request->getQueryParam('id_location');
    try {
      $stmt = $this->db->prepare("UPDATE location SET
                                country = :co,
                                city = :ci,
                                zip = :zp,
                                street_name = :sna,
                                street_number = :snu,
                                name = :na,
                                latitude = :la,
                                longitude = :lo
                                WHERE id_location = :iloc");
      $stmt->bindValue(":co", empty($formData['country']) ? null : $formData['country']);
      $stmt->bindValue(":ci", empty($formData['city']) ? null : $formData['city']);
      $stmt->bindValue(":zp", empty($formData['zip']) ? null : $formData['zip']);
      $stmt->bindValue(":sna", empty($formData['street_name']) ? null : $formData['street_name']);
      $stmt->bindValue(":snu", empty($formData['street_number']) ? null : $formData['street_number']);
      $stmt->bindValue(":na", empty($formData['name']) ? null : $formData['name']);
      $stmt->bindValue(":la", empty($formData['latitude']) ? null : $formData['latitude']);
      $stmt->bindValue(":lo", empty($formData['longitude']) ? null : $formData['longitude']);
      $stmt->bindValue(":iloc", $id_location);
      $stmt->execute();
	    $tplVars['message'] = "Location succefully updated!";
    } catch (PDOexception $e) {
       	$tplVars['message'] = "ERROR!";  
        $tplVars['err'] = "Error detail: " . $e->getMessage();
        return $this->view->render($response, 'error.latte', $tplVars);
    }
    $tplVars['formData'] = $formData;
    $tplVars['id_location'] = $id_location;
    return $this->view->render($response, 'UpdateLocation.latte', $tplVars);
}); 

$app->get('/locations/delete', function (Request $request, Response $response, $args) { 
    $id_location = $request->getQueryParam('id_location');    
    if (!empty($id_location)) {
        try {
            delete_location($this->db, $id_location);
        } catch (PDOexception $e) {
           	$tplVars['message'] = "ERROR!";
            $tplVars['err'] = "Error detail: " . $e->getMessage();  
            return $this->view->render($response, 'error.latte', $tplVars);
        }
    } else {
       	$tplVars['message'] = "ERROR!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    }
    return $response->withHeader('Location', $this->router->pathFor('locations'));
})->setName ('location_Delete');

// Contacts
$app->get('/contacts/update', function (Request $request, Response $response, $args) {
    $params = $request->getQueryParams();
    $id_person = $request->getQueryParam('id_person'); 
    $tplVars['first_name'] = $params['first_name'];
    $tplVars['id_person'] = $params['id_person'];  
    if (!empty($id_person)) {
      	try {
      	    $tplVars['contacts'] = show_contacts($this->db, $params['id_person']);
      	} catch (PDOexception $e) {
           	$tplVars['message'] = "ERROR!";  
            $tplVars['err'] = "Error detail: " . $e->getMessage();
            return $this->view->render($response, 'error.latte', $tplVars);
        }
    } else {
       	$tplVars['message'] = "ERROR!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    }
    return $this->view->render($response, 'UpdateContact.latte', $tplVars);                                                                              
})->setName('contact_Update');

$app->get('/contact/delete', function (Request $request, Response $response, $args) { 
    $id_contact = $request->getQueryParam('id_contact'); 
    $params = $request->getQueryParams();
    $tplVars['first_name'] = $params['first_name'];
    $tplVars['id_person'] = $params['id_person'];   
    if (!empty($id_contact)) {
        try {
            delete_contact($this->db, $id_contact);
            $tplVars['contacts'] = show_contacts($this->db, $params['id_person']);  
        } catch (PDOexception $e) {
           	$tplVars['message'] = "ERROR!";  
            $tplVars['err'] = "Error detail: " . $e->getMessage();
            return $this->view->render($response, 'error.latte', $tplVars);
        }
    } else {
       	$tplVars['message'] = "ERROR!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    }
    return $response->withHeader('Location', $this->router->pathFor('contact_Update') . '?id_person=' . $params['id_person'] . '&first_name=' . $params['first_name'] );
})->setName('delete_Contact');

$app->post('/contacts/update', function (Request $request, Response $response, $args) {
    $formData = $request->getParsedBody(); 
    $params = $request->getQueryParams(); 
    $tplVars['first_name'] = $params['first_name'];
    $tplVars['id_person'] = $params['id_person'];  
    try {add_contacts($this->db, $params['id_person'], $formData);
    } catch (PDOexception $e) {
          	$tplVars['message'] = "You cannot add two identical contacts!";  
            $tplVars['err'] = "Error detail: " . $e->getMessage();
            return $this->view->render($response, 'error.latte', $tplVars);
    } 
    $tplVars['formData'] = $formData;
    $tplVars['contacts'] = show_contacts($this->db, $params['id_person']);  
    return $this->view->render($response, 'UpdateContact.latte', $tplVars);
});

// Relations
$app->get('/relations/update', function (Request $request, Response $response, $args) {
    $params = $request->getQueryParams();
    $id_person = $request->getQueryParam('id_person'); 
    $tplVars['first_name'] = $params['first_name'];
    $tplVars['id_person'] = $params['id_person'];  
    if (!empty($id_person)) {
      	try {
      	    $tplVars['persons'] = show_all_persons_except_one($this->db, $params['id_person']);
      	    $tplVars['relations'] = show_relations($this->db, $params['id_person']);
      	} catch (PDOexception $e) {
           	$tplVars['message'] = "ERROR!";  
            $tplVars['err'] = "Error detail: " . $e->getMessage();
            return $this->view->render($response, 'error.latte', $tplVars);
        }
    } else {
       	$tplVars['message'] = "ERROR!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    }
    return $this->view->render($response, 'UpdateRelation.latte', $tplVars);                                                                              
})->setName('relation_Update');

$app->get('/relation/delete', function (Request $request, Response $response, $args) { 
    $id_relation = $request->getQueryParam('id_relation'); 
    $params = $request->getQueryParams();
    $tplVars['first_name'] = $params['first_name'];
    $tplVars['id_person'] = $params['id_person'];  
    if (!empty($id_relation)) {
        try {
            delete_relation($this->db, $id_relation);
            $tplVars['relations'] = show_relations($this->db, $params['id_person']);  
          	$tplVars['persons'] = show_all_persons_except_one($this->db, $params['id_person']);
            $tplVars['message'] = "Relation deleted";  
        } catch (PDOexception $e) {
           	$tplVars['message'] = "ERROR!";  
            return $this->view->render($response, 'error.latte', $tplVars);
        }
    } else {
       	$tplVars['message'] = "ERROR!";  
        return $this->view->render($response, 'error.latte', $tplVars);
    }
   return $response->withHeader('Location', $this->router->pathFor('relation_Update') . '?id_person=' . $params['id_person'] . '&first_name=' . $params['first_name'] );
})->setName ('delete_Relation');

$app->post('/relations/update', function (Request $request, Response $response, $args) {
    $formData = $request->getParsedBody(); 
    $params = $request->getQueryParams(); 
    $tplVars['first_name'] = $params['first_name'];
    $tplVars['id_person'] = $params['id_person'];  
    try {add_relation($this->db, $params['id_person'], $formData);
        $tplVars['message'] = "Relation added"; 
    } catch (PDOexception $e) {
          	$tplVars['message'] = "You cannot add two identical relations!";  
            $tplVars['err'] = "Error detail: " . $e->getMessage();
            return $this->view->render($response, 'error.latte', $tplVars);           
    } 
    $tplVars['formData'] = $formData;
    $tplVars['relations'] = show_relations($this->db, $params['id_person']);
    $tplVars['persons'] = show_all_persons_except_one($this->db, $params['id_person']);   
    return $this->view->render($response, 'UpdateRelation.latte', $tplVars);
});