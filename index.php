<form method="POST" action="index.php">
    Wpisz nazwisko: <input type="text" name="nazwisko">
    <input type="submit" value="Filtruj">
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "szkola";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

if(isset($_POST['nazwisko']) && $_POST['nazwisko'] != '') {
    $nazwisko = $_POST['nazwisko'];
    $nazwisko = mysqli_real_escape_string($conn, $nazwisko);

    $sql = "SELECT * FROM uczniowie WHERE nazwisko='$nazwisko'";
} else {
    $sql = "SELECT * FROM uczniowie";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'><tr><th>Imię</th><th>Nazwisko</th><th>Wiek</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["imie"]."</td><td>".$row["nazwisko"]."</td><td>".$row["wiek"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Brak wyników";
}
mysqli_close($conn);
?>