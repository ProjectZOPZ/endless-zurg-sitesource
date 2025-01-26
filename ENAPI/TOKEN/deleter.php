<?php
$link = mysqli_connect("localhost", "everlasting_rot", "yat&SweT4anO_owraP3+", "everlasting_database");

if ($link === false) {
    http_response_code(503);
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$deleteExpiredQuery = "DELETE FROM tokens WHERE expires < UNIX_TIMESTAMP(NOW())";
$deleteStmt = mysqli_prepare($link, $deleteExpiredQuery);

if ($deleteStmt) {
    $deleteResult = mysqli_stmt_execute($deleteStmt);
    
    if ($deleteResult) {
        echo "Expired tokens deleted successfully.";
    } else {
        echo "Error deleting expired tokens: " . mysqli_error($link);
    }
    mysqli_stmt_close($deleteStmt);
} else {
    echo "Error preparing delete statement: " . mysqli_error($link);
}
mysqli_close($link);
?>
