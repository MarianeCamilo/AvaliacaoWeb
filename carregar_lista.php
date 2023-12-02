<?php

include __DIR__ . '/header.php';
$hostname = "localhost";
$user = "root";
$password = "";
$database = "db_crud_teste";
// Create connection
$conn = mysqli_connect($hostname, $user, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * from cliente";
$result = mysqli_query($conn, $sql);
?>

<table class="table p-3">
    <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
    </tr>
    <?php


    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {

            echo " <tr> <td  class='p-2'> " . $row["nome"] . "  </td>";
            echo "<td  class='p-2'>" . $row["email"] . " </td>";
            echo "<td  class='p-2'>" . $row["telefone"] . "</td> </tr>";

        }
    } else {
        echo "No messages";
    }

    mysqli_close($conn);
    ?>
</table>





<?php
include __DIR__ . '/footer.php';