<?php
    include('phpCode.php');
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="style.css">
        <title>Index</title>
    </head>
    <body>
        <h1>Registration</h1>
        <hr>
        <h4>Add Person</h4>
        <form method="POST" >
            <table>
                <tbody>
                    
                    <tr>
                        <td><label class="name-label" for="name">Name:</label></td>
                        <td><input  type="text" class="name-input" name="name" placeholder="Your Name" required ></td>
                    </tr>
                    <tr>
                        <td><label class="address-label" for="address">Address:</label></td>
                        <td><input type="text" class="address-input" name="address" placeholder="Your Address" required ></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input name="saveButton" value="Save" type="submit" class="save-button"   ></td>
                    </tr>
                </tbody>
            </table>
        </form>
        
<?php

    if(isset($_POST['saveButton'])){
        $name = $_POST["name"];
        $address = $_POST["address"];
        $queryTest = "INSERT INTO informations (Name, Address) VALUES ('$name', '$address')"; 
        
        if(mysqli_query($connect, $queryTest)){
            echo '<div class="sucsess"> <h5>Saved Sucsessfuly!</h5> </div>';
            // echo "<meta http-equiv='refresh' content='1'>";
        }else{
            echo'<div class="sucsess"> <h5 style="background-color:red";>Update Not Work!</h5> </div>';
        }
    }

    
?>
<hr>

<h4>Update Person</h4>
<form method="post">
    <table>
        <tbody>
            <tr>
                <td><label class="id-label" for="id">ID:</label></td>
                <td><input  type="text" class="id-input" name="idUpdate" placeholder="The Id Of Person" required ></td>
            </tr>
            <tr>
                <td><label class="new-name-label" for="newName">New Name:</label></td>
                <td><input type="text" class="new-name-input" name="newName" placeholder="The New Name Of Person" ></td>
            </tr>
            <tr>
                <td><label class="new-Addresse-label" for="newAddresse">New Addrsse:</label></td>
                <td><input  type="text" class="new-address-input" name="newAddresse" placeholder="The New Addresse Of Person" ></td>
            </tr>

             <tr>
                <td></td>
                <td><input name="updateButton" value="Update" type="submit" class="update-button"></td>
            </tr>
        </tbody>
    </table>
</form>

<?php

    if(isset($_POST['updateButton'])){

        $idUpdate = $_POST['idUpdate'];
        $newName = $_POST['newName'];
        $newAddresse = $_POST['newAddresse'];
        if(!empty($newName) && !empty($newAddresse)){
        
            $idUpdate = $_POST['idUpdate'];
            $newName = $_POST['newName'];
            $newAddresse = $_POST['newAddresse'];
            $updateQuery = "UPDATE informations SET Name='$newName', Address='$newAddresse' WHERE Id='$idUpdate'";

            if(mysqli_query($connect, $updateQuery)){
                echo '<div class="sucsess"> <h5>Update Sucsessfuly!</h5> </div>';
                // echo "<meta http-equiv='refresh' content='1'>";
            }

        }elseif(!empty($newAddresse)){
            $idUpdate = $_POST['idUpdate'];
            
            $updateQuery = "UPDATE informations SET Address='$newAddresse' WHERE Id='$idUpdate'";

            if(mysqli_query($connect, $updateQuery)){
                echo '<div class="sucsess"> <h5>Update Sucsessfuly!</h5> </div>';
                // echo "<meta http-equiv='refresh' content='1'>";
            }

        }elseif(!empty($newName)){
            $idUpdate = $_POST['idUpdate'];
            $newName = $_POST['newName'];
            
            $updateQuery = "UPDATE informations SET Name='$newName' WHERE Id='$idUpdate'";

            if(mysqli_query($connect, $updateQuery)){
                echo '<div class="sucsess"> <h5>Update Sucsessfuly!</h5> </div>';
                // echo "<meta http-equiv='refresh' content='1'>";
            }
        }else{
            echo'<div class="sucsess"> <h5 style="background-color:red";>Update Not Work!</h5> </div>';
        }
    }

?>
    <hr>
    <h4>Delete Person</h4>
    <form method="post">
        <table>
            <tbody>
                <tr>
                    <td><label class="id-label" for="idDelete">ID:</label></td>
                    <td><input  type="text" class="id-input" name="idDelete" placeholder="The Id Of Person" required ></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input name="deleteButton" value="Delete" type="submit" class="delete-button"></td>
                </tr>
            </tbody>
        </table>
    </form>
    
<?php
if(isset($_POST['deleteButton'])){
    $idDelete = $_POST['idDelete'];
    $deleteQuery = "DELETE FROM informations WHERE Id ='$idDelete'";
    if(mysqli_query($connect, $deleteQuery)){
        echo '<div class="sucsess"> <h5>Delete Sucsessfuly!</h5> </div>';
        // echo "<meta http-equiv='refresh' content='1'>";
    }else{
        echo'<div class="sucsess"> <h5 style="background-color:red";>Delete Not Work!</h5> </div>';
    }
}


?>

    <hr>
    <form method="post">
        <input name="showPersonnes" type="submit" value="Show Personnes &rarr;" class="show-pers-button">
    </form>
    <?php
        $selectQuery = "SELECT * FROM informations";
        $result = mysqli_query($connect, $selectQuery);
        if(isset($_POST['showPersonnes'])){
            if(mysqli_num_rows($result) > 0){
        
    ?>
    <table class="database">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                
               

               
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr> <td>" . $row['Id'] . "</td> <td>" . $row['Name'] . "</td> <td>" . $row['Address'] . "</td></tr>";
                    }
                }else{
                    echo'<div class="no-personne">No Personne In The Data Base!</div>';
                }
            }
            ?>
            
        </tbody>
    </table>
    <?php
        mysqli_close($connect);
    ?>
    
</body>
</html>
