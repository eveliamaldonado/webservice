<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Obtener todos los estudiantes

$app->get('/api/estudiantes', function(Request $request, Response $response){
	//echo "Estudiantes";

	$sql = "select * from estudiante";

	try{

		// Get DB Object
		$db = new db();
		// Connect

		$db = $db->connect();

		$stmt = $db->query($sql);
		$estudiantes = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		echo json_encode($estudiantes);

	} catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';


	}


});


// Obtener un estudiante por no de control
$app->get('/api/estudiantes/{nocontrol}', function(Request $request, Response $response){
    $nocontrol = $request->getAttribute('nocontrol');

    $sql = "SELECT * FROM estudiante WHERE No_contro = $nocontrol";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $estudiante = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($estudiante);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Agregar un estudiante
$app->post('/api/estudiantes/add', function(Request $request, Response $response){
    $nocontrol = $request->getParam('nocontrol');
    $nombre = $request->getParam('nombre');
    $apellidop = $request->getParam('apellidop');
    $apellidom = $request->getParam('apellidom');
    $semestre = $request->getParam('semestre');
    $carrera_clave = $request->getParam('carrera_clave');

    $sql = "INSERT INTO estudiante (No_contro, nombre_estudiante, Apellido_Pestudiante, Apeliido_Mestudiante, semestre, carrera_clave) VALUES (:nocontrol, :nombre, :apellidop, :apellidom, :semestre, :carrera_clave)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nocontrol',      $nocontrol);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->bindParam(':apellidop',      $apellidop);
        $stmt->bindParam(':apellidom',      $apellidom);
        $stmt->bindParam(':semestre',       $semestre);
        $stmt->bindParam(':carrera_clave',  $carrera_clave);

        $stmt->execute();

        echo '{"notice": {"text": "Estudiante agregado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar estudiante
$app->put('/api/estudiantes/update/{nocontrol}', function(Request $request, Response $response){
    $nocontrol = $request->getParam('nocontrol');
    $nombre = $request->getParam('nombre');
    $apellidop = $request->getParam('apellidop');
    $apellidom = $request->getParam('apellidom');
    $semestre = $request->getParam('semestre');
    $carrera_clave = $request->getParam('carrera_clave');

    $sql = "UPDATE estudiante SET
                No_contro               = :nocontrol,
                nombre_estudiante       = :nombre,
                Apellido_Pestudiante   = :apellidop,
                Apeliido_Mestudiante   = :apellidom,
                semestre                = :semestre,
                carrera_clave           = :carrera_clave
            WHERE No_contro = $nocontrol";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nocontrol',      $nocontrol);
        $stmt->bindParam(':nombre',         $nombre);
        $stmt->bindParam(':apellidop',      $apellidop);
        $stmt->bindParam(':apellidom',      $apellidom);
        $stmt->bindParam(':semestre',       $semestre);
        $stmt->bindParam(':carrera_clave',  $carrera_clave);

        $stmt->execute();

        echo '{"notice": {"text": "Estudiante actualizado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar estudiante
$app->delete('/api/estudiantes/delete/{nocontrol}', function(Request $request, Response $response){
    $nocontrol = $request->getAttribute('nocontrol');

    $sql = "DELETE FROM estudiante WHERE No_contro = $nocontrol";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Estudiante eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';

    }
});


$app2 = new \Slim\App;


// Obtener todas las actividades complementarias

$app->get('/api/actividades', function(Request $request, Response $response){
	//echo "Carreras";

	$sql = "select * from act_complementaria";

	try{

		// Get DB Object
		$db = new db();
		// Connect

		$db = $db->connect();

		$stmt = $db->query($sql);
		$actividades = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		echo json_encode($actividades);

	} catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';


	}


});


// Obtener una actividad por clave
$app->get('/api/actividades/{clave_Act}', function(Request $request, Response $response){
    $nocontrol = $request->getAttribute('clave_Act');

    $sql = "SELECT * FROM act_complementaria WHERE clave_act = $clave_Act";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $act_complementaria = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($act_complementaria);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Agregar una actividad
$app->post('/api/actividades/add', function(Request $request, Response $response){
    $clave_Act = $request->getParam('clave_Act');
    $nombreAct = $request->getParam('nombreAct');
   

    $sql = "INSERT INTO act_complementaria (clave_act, nombre_actcomplementaria) VALUES (:clave_Act, :nombreAct)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':clave_Act',      $clave_Act);
        $stmt->bindParam(':nombreAct',         $nombreAct);
        

        $stmt->execute();

        echo '{"notice": {"text": "Actividad agregada"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar actividad
$app->put('/api/actividades/update/{clave_Act}', function(Request $request, Response $response){
    $clave_Act = $request->getParam('clave_Act');
    $nombreAct = $request->getParam('nombreAct');
   

    $sql = "UPDATE act_complementaria SET
                clave_act             = :clave_Act,
                nombre_actcomplementaria      = :nombre_actcomplementaria
                
            WHERE clave_act = $clave_Act";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':clave_Act',      $clave_Act);
        $stmt->bindParam(':nombreAct',         $nombreAct);
       

        $stmt->execute();

        echo '{"notice": {"text": "actividad actualizada"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar actividad
$app->delete('/api/actividades/delete/{clave_Act}', function(Request $request, Response $response){
    $clave_Act = $request->getAttribute('clave_Act');

    $sql = "DELETE FROM act_complementaria WHERE clave_act = $clave_Act";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Actividad eliminada"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';

    }
});



$app3 = new \Slim\App;


// Obtener todos los departamentos

$app->get('/api/departamentos', function(Request $request, Response $response){
	//echo "Departamentos";

	$sql = "select * from departamento";

	try{

		// Get DB Object
		$db = new db();
		// Connect

		$db = $db->connect();

		$stmt = $db->query($sql);
		$departamentos = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		echo json_encode($departamentos);

	} catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';


	}


});


// Obtener un departamento por clave
$app->get('/api/departamentos/{clavedepa}', function(Request $request, Response $response){
    $clavedepa = $request->getAttribute('clavedepa');

    $sql = "SELECT * FROM departamento WHERE clave_depa = $clavedepa";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $departamento = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($departamento);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Agregar un departamento
$app->post('/api/departamentos/add', function(Request $request, Response $response){
    $clavedepa = $request->getParam('clavedepa');
    $nombredepa = $request->getParam('nombredepa');
    $rfc = $request->getParam('rfc');
   

    $sql = "INSERT INTO departamento (clave_depa, nombre_departamento, trabajador_rfc) VALUES (:clavedepa, :nombredepa, :rfc)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':clavedepa',      $clavedepa);
        $stmt->bindParam(':nombredepa',         $nombredepa);
         $stmt->bindParam(':rfc',         $rfc);
        

        $stmt->execute();

        echo '{"notice": {"text": "departamento agregado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar departamento
$app->put('/api/departamentos/update/{clavedepa}', function(Request $request, Response $response){
    $clavedepa = $request->getParam('clavedepa');
    $nombredepa = $request->getParam('nombredepa');
    $rfc = $request->getParam('rfc');

   

    $sql = "UPDATE departamento SET
                clave_depa            = :clavedepa,
                nombre_departamento     = :nombredepa,
                trabajador_rfc      = :rfc
                
            WHERE clave_depa = $clavedepa";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':clavedepa',      $clavedepa);
        $stmt->bindParam(':nombredepa',         $nombredepa);
        $stmt->bindParam(':rfc',         $rfc);
       

        $stmt->execute();

        echo '{"notice": {"text": "departamento actualizado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar departamento
$app->delete('/api/departamentos/delete/{clavedepa}', function(Request $request, Response $response){
    $clavedepa = $request->getAttribute('clavedepa');

    $sql = "DELETE FROM departamento WHERE clave_instituto = $clavedepa";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "departamento eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';

    }
});



$app4 = new \Slim\App;

// Obtener todos los instructores
$app->get('/api/instructores', function(Request $request, Response $response){
    //echo "Estudiantes";
    $sql = "select * from instructor";

    try{
        // Obtener el objeto DB 
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $instructor= $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        //print_r($carrera);
        echo json_encode($instructor);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Obtener instructores mediante su RFC
$app->get('/api/instructores/{rfc}', function(Request $request, Response $response){
    $rfc = $request->getAttribute('rfc');

    $sql = "SELECT * FROM instructor WHERE rfc_instructor = '" . $rfc ."'";;

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $instructor = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        print_r($instructor);
        //echo json_encode($carrera);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Agregar instructores
$app->post('/api/instructores/add', function(Request $request, Response $response){
    $rfc = $request->getParam('rfc');
    $nombreInstructor= $request->getParam('nombreInstructor');
    $apepaterno= $request->getParam('apepaterno');
    $apematerno= $request->getParam('apematerno');
    $act= $request->getParam('act');


    $sql = "INSERT INTO instructor (rfc_instructor, nombre_instructor, ApellidoP_instructor, ApellidoM_instructor, act_complementaria_clave_act) VALUES (:rfc, :nombreInstructor, :apepaterno, :apematerno, :act)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':rfc',      $rfc);
        $stmt->bindParam(':nombreInstructor',         $nombreInstructor);
        $stmt->bindParam(':apepaterno',         $apepaterno);
        $stmt->bindParam(':apematerno',         $apematerno);
        $stmt->bindParam(':act',         $act);

        $stmt->execute();

        echo '{"notice": {"text": "Instructor agregado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Actualizar instructor
$app->put('/api/instructores/update/{rfc}', function(Request $request, Response $response){
    $rfc = $request->getParam('rfc');
    $nombreInstructor = $request->getParam('nombreInstructor');
    $apepaterno = $request->getParam('apepaterno');
    $apematerno = $request->getParam('apematerno');
    $act = $request->getParam('act');
   

    $sql = "UPDATE instructor SET
                rfc_instructor = :rfc,
                nombre_instructor     = :nombreInstructor,
                ApellidoP_instructor   = :apepaterno,
                ApellidoM_instructor  = :apematerno,
                act_complementaria_clave_act              = :act
          
            WHERE rfc_instructor ='" . $rfc ."'";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':rfc',      $rfc);
        $stmt->bindParam(':nombreInstructor',         $nombreInstructor);
        $stmt->bindParam(':apepaterno',      $apepaterno);
        $stmt->bindParam(':apematerno',      $apematerno);
        $stmt->bindParam(':act',       $act);
    

        $stmt->execute();

        echo '{"notice": {"text": "Instructor actualizado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
//Eliminar Instructor
$app->delete('/api/instructores/delete/{rfc}', function(Request $request, Response $response){
    $rfc = $request->getAttribute('rfc');

    $sql = "DELETE FROM instructor WHERE rfc_instructor = '" . $rfc ."'";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Instructor eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});



$app5 = new \Slim\App;


// Obtener todos los carreras

$app->get('/api/carreras', function(Request $request, Response $response){
	//echo "Carreras";

	$sql = "select * from carrera";

	try{

		// Get DB Object
		$db = new db();
		// Connect

		$db = $db->connect();

		$stmt = $db->query($sql);
		$carreras = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		echo json_encode($carreras);

	} catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';


	}


});


// Obtener una carrera por clave
$app->get('/api/carreras/{clavecarrera}', function(Request $request, Response $response){
    $clavecarrera = $request->getAttribute('clavecarrera');

    $sql = "SELECT * FROM carrera WHERE clave_carrera = $clavecarrera";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $carrera = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($carrera);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Agregar una carrera
$app->post('/api/carreras/add', function(Request $request, Response $response){
    $clavecarrera = $request->getParam('clavecarrera');
    $nombrecarrera = $request->getParam('nombrecarrera');
   

    $sql = "INSERT INTO carrera (clave_carrera, nombre_carrera) VALUES (:clavecarrera, :nombrecarrera)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':clavecarrera',      $clavecarrera);
        $stmt->bindParam(':nombrecarrera',         $nombrecarrera);
        

        $stmt->execute();

        echo '{"notice": {"text": "carrera agregado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar carrera
$app->put('/api/carreras/update/{clavecarrera}', function(Request $request, Response $response){
    $clavecarrera = $request->getParam('clavecarrera');
    $nombrecarrera = $request->getParam('nombrecarrera');
   

    $sql = "UPDATE carrera SET
                clave_carrera            = :clavecarrera,
                nombre_carrera      = :nombrecarrera
                
            WHERE clave_carrera = $clavecarrera";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':clavecarrera',      $clavecarrera);
        $stmt->bindParam(':nombrecarrera',         $nombrecarrera);
       

        $stmt->execute();

        echo '{"notice": {"text": "carrera actualizada"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar carrera
$app->delete('/api/carreras/delete/{clavecarrera}', function(Request $request, Response $response){
    $clavecarrera = $request->getAttribute('clavecarrera');

    $sql = "DELETE FROM carrera WHERE clave_carrera = $clavecarrera";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "carrera eliminada"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';

    }
});



$app6 = new \Slim\App;


// Obtener todos los institutos

$app->get('/api/institutos', function(Request $request, Response $response){
	//echo "Carreras";

	$sql = "select * from instituto";

	try{

		// Get DB Object
		$db = new db();
		// Connect

		$db = $db->connect();

		$stmt = $db->query($sql);
		$institutos = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		echo json_encode($institutos);

	} catch(PDOException $e){
		echo '{"error": {"text": '.$e->getMessage().'}';


	}


});


// Obtener un instituto por clave
$app->get('/api/institutos/{claveinstituto}', function(Request $request, Response $response){
    $claveinstituto = $request->getAttribute('claveinstituto');

    $sql = "SELECT * FROM instituto WHERE clave_instituto = '$claveinstituto'";
    

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->query($sql);
        $instituto = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($instituto);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Agregar un instituto
$app->post('/api/institutos/add', function(Request $request, Response $response){
    $claveinstituto = $request->getParam('claveinstituto');
    $nombre_instituto = $request->getParam('nombre_instituto');
   

    $sql = "INSERT INTO instituto (clave_instituto, nombreinstituto) VALUES (:claveinstituto, :nombre_instituto)";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':claveinstituto',      $claveinstituto);
        $stmt->bindParam(':nombre_instituto',         $nombre_instituto);
        

        $stmt->execute();

        echo '{"notice": {"text": "instituto agregado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Actualizar instituto
$app->put('/api/institutos/update/{claveinstituto}', function(Request $request, Response $response){
    $claveinstituto = $request->getParam('claveinstituto');
    $nombre_instituto = $request->getParam('nombre_instituto');
   

    $sql = "UPDATE instituto SET
                clave_instituto            = :claveinstituto,
                nombreinstituto      = :nombre_instituto
                
            WHERE clave_instituto = '$claveinstituto'";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':claveinstituto',      $claveinstituto);
        $stmt->bindParam(':nombre_instituto',         $nombre_instituto);
       

        $stmt->execute();

        echo '{"notice": {"text": "instituto actualizado"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar instituto
$app->delete('/api/institutos/delete/{claveinstituto}', function(Request $request, Response $response){
    $claveinstituto = $request->getAttribute('claveinstituto');

    $sql = "DELETE FROM instituto WHERE clave_instituto = '$claveinstituto'";

    try{
        // Obtener el objeto DB
        $db = new db();
        // Conectar
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "instituto eliminado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';

    }
});

















