<?php 
session_start();
include "db_connection1.php";

$local_username = $_SESSION['email'];
$maincategory = $_POST["maincategory"];
$category = $_POST["category"];

// Consulta para obtener el categorycounter oldFine
$query = "SELECT categorycounter FROM videotips_app_access_list WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $local_username);  // Evita la inyección SQL
$stmt->execute();
$stmt->bind_result($categorycounter);
$stmt->fetch();
$stmt->close();


// Consulta para obtener el extendcounterfeature
$query4 = "SELECT extendcounterfeature FROM videotips_app_access_list WHERE username = ?";
$stmt = $conn->prepare($query4);
$stmt->bind_param("s", $local_username);  // Evita la inyección SQL
$stmt->execute();
$stmt->bind_result($extendcounterfeature);
$stmt->fetch();
$stmt->close();


/*
// Consulta para identificar si hay dupliidad de subcategiría
$query6 = "SELECT category FROM videotips_viodetipscategory WHERE category = ? and username = ?";
$stmt = $conn->prepare($query6);
$stmt->bind_param("s", $category,$local_username);  // Evita la inyección SQL
$stmt->execute();
$stmt->bind_result($categoryresult);
$stmt->fetch();
$stmt->close();
*/
  
// Verificación y lógica basada en el valor de categorycounter
if (is_numeric($categorycounter) && $categorycounter > 4 && $extendcounterfeature === 0) {
                echo "You have reached the 5 free subcategories registration limit. To continue adding more, please check our plans.";
                $_SESSION['message'] = 'Subcategories not saved Successfully';
                $_SESSION['message_type'] = 'No Success';
                header("refresh:7; url=addcategory.php");
                exit(); // Importante para detener la ejecución después de redirigir
}

if ((is_numeric($categorycounter) && $categorycounter <= 4) || (is_numeric($categorycounter) && $categorycounter > 4 && $extendcounterfeature === 1))  {
                // Inserta la nueva categoría y maincategory
                $query1 = "INSERT INTO videotips_viodetipscategory (maincategory, category, username) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($query1);
                $stmt->bind_param("sss", $maincategory, $category, $local_username);
                $resultado1 = $stmt1->execute();
                $stmt->close();

                $query2 = "INSERT INTO videotips_maincategory (maincategory, username) VALUES (?, ?)";
                $stmt = $conn->prepare($query2);
                $stmt->bind_param("ss", $maincategory, $local_username);
                $resultado = $stmt2->execute();
                $stmt->close();

                // Si la primera inserción fue exitosa, actualiza el categorycounter
               if ($resultado1) {
                    $query3 = "UPDATE videotips_app_access_list SET categorycounter = categorycounter + 1 WHERE username = ?";
                    $stmt = $conn->prepare($query3);
                    $stmt->bind_param("s", $local_username);
                    $stmt->execute();
                    $stmt->close();

                    echo "Category Saved";
                    $_SESSION['message'] = 'Category Saved Successfully';
                    $_SESSION['message_type'] = 'Success';
                    header("refresh:7; url=addcategory.php");
                    exit(); // Importante para detener la ejecución después de redirigir
                }
            }
?>