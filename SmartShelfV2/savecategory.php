<?php 
            include "sessions.php";
            include "sessionvalidation.php";
            include "db_connection1.php";

            $local_username = $_SESSION['email'];
            $maincategory = $_POST["maincategory"];
            $category = $_POST["category"];
            $savedcategory = $_SESSION['savedcategory'];
            $categoryduplicated = $_SESSION['categoryduplicated'];
            $FreeSubcateryReached = $_SESSION['FreeSubcateryReached'];
            
            $stmt = $conn->prepare("SELECT categorycounter FROM videotips_app_access_list WHERE username = ?");
            $stmt->bind_param("s", $local_username);
            $stmt->execute();
            $result = $stmt->get_result();
            $categorycounter = $result->fetch_assoc()['categorycounter'];
            
            $stmt = $conn->prepare("SELECT extendcounterfeature FROM videotips_app_access_list WHERE username = ?");
            $stmt->bind_param("s", $local_username);
            $stmt->execute();
            $result = $stmt->get_result();
            $extendcounterfeature = $result->fetch_assoc()['extendcounterfeature'];
            
            $stmt = $conn->prepare("SELECT category FROM videotips_viodetipscategory WHERE category = ? AND username = ?");
            $stmt->bind_param("ss", $category, $local_username);
            $stmt->execute();
            $categoryresult = $stmt->get_result();
            
          if ($categoryresult->num_rows > 0){
            $_SESSION['duplicatedcategory'] =1;;
            header("refresh:0; url=addcategory.php");
            exit();
          }else{

            if ($categorycounter > 999 && $extendcounterfeature == 0) {
              $_SESSION['FreeSubcateryReached']=1;
              header("refresh:0; url=addcategory.php");
              exit();
            }
            
            if ($categorycounter <= 999 || ($categorycounter > 999 && $extendcounterfeature == 1)) {
                $stmt = $conn->prepare("INSERT INTO videotips_viodetipscategory (maincategory, category, username) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $maincategory, $category, $local_username);
                
                if ($stmt->execute()) {
                    $stmt = $conn->prepare("UPDATE videotips_app_access_list SET categorycounter = categorycounter + 1 WHERE username = ?");
                    $stmt->bind_param("s", $local_username);
                    $stmt->execute();
                    $_SESSION['savedcategory']=1;
                    header("refresh:0; url=addcategory.php");
                    exit();

                } else {
                    $_SESSION['savedcategory']=2;
                    header("refresh:0; url=addcategory.php");
                    exit();
                }
            }
          }  
?>