<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $inputString = $_POST['integers'];
        
        // Explode the string into an array using comma as the delimiter
        $integersArray = explode(',', $inputString);

        // Convert the array elements to integers
        $integersArray = array_map('intval', $integersArray);
        $counter = 0;
        foreach ($integersArray as $x ){
                $counter;
            if ( $x == 0 ){
                $counter++;
            }elseif( $x % 3 == 0 ){
                $counter++;
            }
        }
    
        echo $counter;

    }


    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="input1">Enter integers (comma-separated):</label>
        <input type="text" name="integers" id="integers">
        <br>
        <input type="submit" value="Submit">
    </form>

</body>
</html>