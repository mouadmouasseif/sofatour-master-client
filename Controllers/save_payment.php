<?php

session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

    include 'connection_database.php';

    header('Content-Type: application/json');
    
    $uploadDirectory = '../uploads/';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idDevis = $_POST['id_devis'];
        $modes = $_POST['PaiementCreationTable-name'];
        $montants = $_POST['PaiementCreationTable-data'];
        $exonerers = isset($_POST['PaiementCreationTable-exonerer']) ? $_POST['PaiementCreationTable-exonerer'] : [];
        $fileCount = count($_FILES['PaiementCreationTable-document']['name']);
    
        $response = [];
       
        
        // Handle each row
        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES['PaiementCreationTable-document']['error'][$i] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['PaiementCreationTable-document']['tmp_name'][$i];
                $fileName = $_FILES['PaiementCreationTable-document']['name'][$i];
                $fileSize = $_FILES['PaiementCreationTable-document']['size'][$i];
                $fileType = $_FILES['PaiementCreationTable-document']['type'][$i];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
    
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadDirectory . $newFileName;
    
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Insert document record
                    $stmt = $conn->prepare('INSERT INTO document (file_name, file_path, file_type) VALUES (?, ?, ?)');
                    $stmt->execute([$fileName, $dest_path, $fileType]);
                    $documentId = $conn->lastInsertId();
    
                    // Insert payment record
                    $stmt = $conn->prepare('INSERT INTO devis_paiements (statut, client_devis_client, devis_mode_paiements, Montant, avec_exoneration, document , created ) VALUES (?, ?, ?, ?, ? , ? , NOW())');
                    $stmt->execute(['En attente', $idDevis, $modes[$i], $montants[$i], isset($exonerers[$i]) ? 1 : 0 , $documentId]);
                    // $devisPaiementsId = $conn->lastInsertId();
    
                    // Insert document_paiement record
                    // $stmt = $conn->prepare('INSERT INTO document_paiement (devis_paiements, document) VALUES (?, ?)');
                    // $stmt->execute([$devisPaiementsId, $documentId]);
    
                    $response[] = ['status' => 'success', 'message' => 'File uploaded successfully'];
                } else {
                    $response[] = ['status' => 'error', 'message' => 'Error moving file to upload directory'];
                }
            } else {
                $response[] = ['status' => 'error', 'message' => 'Error uploading file'];
            }
        }
    
        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }
    
    






















































































    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $mode_paiements = $_POST['PaiementCreationTable-name'];
    //     $montants = $_POST['PaiementCreationTable-data'];
    //     $documents = $_FILES['PaiementCreationTable-document'];
    
    //     $uploadDir = '../Ressources/documents/paiements/';
    
    //     for ($i = 0; $i < count($mode_paiements); $i++) {
    //         $mode_paiement = htmlspecialchars($mode_paiements[$i]);
    //         $montant = htmlspecialchars($montants[$i]);
    //         $fileName = basename($documents['name'][$i]);
    //         $fileTmpName = $documents['tmp_name'][$i];
    //         $filePath = $uploadDir . $fileName;
    
    //         // Move the uploaded file to the designated directory
    //         if (move_uploaded_file($fileTmpName, $filePath)) {
    //             try {
    //                 // Insert the payment record into the database
    //                 $stmt = $conn->prepare("INSERT INTO devis_paiements (devis_mode_paiements, Montant, document) VALUES (:mode_paiement, :montant, :document)");
    //                 $stmt->bindParam(':mode_paiement', $mode_paiement, PDO::PARAM_STR);
    //                 $stmt->bindParam(':montant', $montant, PDO::PARAM_STR);
    //                 $stmt->bindParam(':document', $filePath, PDO::PARAM_STR);
    //                 $stmt->execute();
    //             } catch (PDOException $e) {
    //                 echo "Error: " . $e->getMessage();
    //             }
    //         } else {
    //             echo "Error uploading file: " . $fileName;
    //         }
    //     }
    //     echo "Records inserted successfully.";
    // }
    // $data = json_decode(file_get_contents("php://input"));

    // // Handle payment data insertion
    // $mode_paiement = $data->mode_paiement;
    // $montant = $data->montant;
    // $document = $data->document;
    
    // // Define payment mode IDs
    // $mode_paiement_ids = [
    //     "Espèces" => 1,
    //     "Chèque" => 2,
    //     "Virement" => 3,
    //     "Prise en charge" => 4
    // ];

    // // Get the corresponding mode_paiement_id
    // $mode_paiement_id = $mode_paiement_ids[$mode_paiement];
    // $statut = 'Impayé';
    // if($mode_paiement_id == 1)
    //     $statut = 'Payé';
    // try {
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //     $query = "INSERT INTO devis_paiements (devis_mode_paiements, Montant,Statut) VALUES (:mode_paiement_id, :montant,:statut)";
    //     $stmt = $conn->prepare($query);
        
    //     $stmt->bindParam(':mode_paiement_id', $mode_paiement_id, PDO::PARAM_INT);
    //     $stmt->bindParam(':montant', $montant, PDO::PARAM_STR);
    //     $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
    //     $stmt->execute();
    
    //     $response = ['success' => true, 'message' => 'Records updated successfully'];
    
    
    //     // Get the last inserted ID to associate with the file
    //     $paiement_id = $conn->lastInsertId();

    //     // Handle file upload if a file was provided
    //     if ($document) {
    //         $file_name = $document->name;
    //         $file_tmp = $document->tmp_name;
    //         $file_path = "../Ressources/documents/paiements/" . $file_name; // Define your upload directory
    //         $file_type = $document->type;
        
            
    //         // Move uploaded file to designated directory
    //         move_uploaded_file($file_tmp, $file_path . $file_name);

    //         // Insert file information into document table
    //         // Define the SQL query
    //         $sql = "INSERT INTO document (file_name, file_path, file_type) VALUES (:file_name, :file_path, :file_type)";

    //         // Prepare the SQL statement
    //         $stmt = $conn->prepare($sql);

    //         // Bind parameters
    //         $stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
    //         $stmt->bindParam(':file_path', $file_path, PDO::PARAM_STR);
    //         $stmt->bindParam(':file_type', $file_type, PDO::PARAM_STR);

    //         // Execute the statement
    //         $stmt->execute();

    //         // Get the document ID
    //         $document_id = $conn->lastInsertId();

    //         // Insert association into document_paiement table
    //         // Define the SQL query
    //         $sql = "INSERT INTO document_paiement (devis_paiements, document) VALUES (:devis_paiements_id, :document_id)";

    //         // Prepare the SQL statement
    //         $stmt = $conn->prepare($sql);

    //         // Bind parameters
    //         $stmt->bindParam(':devis_paiements_id', $devis_paiements_id, PDO::PARAM_INT);
    //         $stmt->bindParam(':document_id', $document_id, PDO::PARAM_INT);

    //         // Execute the statement
    //         $stmt->execute();
    //     }
    // } catch (PDOException $e) {
    //     $response = ['success' => false, 'message' => 'Error updating records: ' . $e->getMessage()];
    // }
    // // Handle response (e.g., send success message back to the client)
    // // echo "Payment data saved successfully!";
    // // Send JSON response
    // header('Content-Type: application/json');
    // echo json_encode($response);


?>