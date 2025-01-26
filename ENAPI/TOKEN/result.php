<?php
$link = mysqli_connect("localhost", "everlasting_rot", "yat&SweT4anO_owraP3+", "everlasting_database");

if ($link === false) {
    http_response_code(503);
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
        $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
        $fileName = $_FILES['fileUpload']['name'];
        $fileSize = $_FILES['fileUpload']['size'];
        $fileType = $_FILES['fileUpload']['type'];

        if ($fileType != 'text/plain') {
            echo "Please upload a valid text file.";
        } else {
            $fileContents = file_get_contents($fileTmpPath);
            $lines = explode("\n", $fileContents);
            $lineCount = count($lines);

            echo "<p>Total number of tokens: $lineCount</p>";

            $insertQuery = "INSERT INTO tokens (token, expires) VALUES (?, UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL 13 HOUR)))";
            $stmt = mysqli_prepare($link, $insertQuery);

            // Initialize counters
            $successCount = 0;
            $failureCount = 0;
            $invalidCount = 0;

            if ($stmt) {
              //  echo "<h4>Processed and Uploaded Tokens:</h4><ul>";
                foreach ($lines as $line) {
                    $trimmedLine = trim($line);

                    if (strpos($trimmedLine, 'XBL3.0 x=') === 0) { // Check if the line starts with "XBL3.0 x="
                        if (!empty($trimmedLine)) {
                            mysqli_stmt_bind_param($stmt, "s", $trimmedLine);
                            $executionResult = mysqli_stmt_execute($stmt);

                            if ($executionResult) {
                                $shortToken = htmlspecialchars(substr($trimmedLine, 0, 35)) . "...";
                             ///  echo "<li>Inserted: " . $shortToken . "</li>";
                                $successCount++;
                            } else {
                                $shortToken = htmlspecialchars(substr($trimmedLine, 0, 35)) . "...";
                                echo "<li>Failed to insert: " . $shortToken . " (" . htmlspecialchars(mysqli_error($link)) . ")</li>";
                                $failureCount++;
                            }
                        }
                    } else {
                        echo "<li>Invalid Token: " . htmlspecialchars($trimmedLine) . "</li>";
                        $invalidCount++;
                    }
                }

            //    echo "</ul>";
                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing statement: " . mysqli_error($link);
            }

            // Display summary
            echo "<h1>Summary:</h1>";
            echo "<p>Total tokens processed: $lineCount</p>";
            echo "<p>Successfully inserted tokens: $successCount</p>";
            echo "<p>Failed to insert tokens: $failureCount</p>";
            echo "<p>Invalid tokens: $invalidCount</p>";
        }
    } else {
        echo "Error: " . $_FILES['fileUpload']['error'];
    }
} else {
    echo "Please upload a file.";
}

mysqli_close($link);
?>
