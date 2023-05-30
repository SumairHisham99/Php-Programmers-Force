<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>

    <?php
    $name=$email=$website=$comment= '';
    $nameErr=$emailErr=$websiteErr=$commentErr= '';

    if ($_SERVER["REQUEST_METHOD"]=='POST'){
        if(empty($_POST['name'])){
            $nameErr = 'Name is Required!';
        }else{
            $name = test_input($_POST['name']);
        }
    }
    if ($_SERVER["REQUEST_METHOD"]=='POST'){
        if(empty($_POST['email'])){
            $emailErr = 'Email is Required!';
        }else{
            $email = test_input($_POST['email']);
        }
    }
    if ($_SERVER["REQUEST_METHOD"]=='POST'){
        $website = test_input($_POST['website']);
    }
    if ($_SERVER["REQUEST_METHOD"]=='POST'){
        $comment = test_input($_POST['comment']);
    }

    //Funtion to exclude extra spaces, and specal characters from input string
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    ?>

    <Form method = 'post' action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name : <input type='text' name='name' value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
    Website: <input type="text" name="website" value="<?php echo $website;?>">
        <span class="error"><?php echo $websiteErr;?></span>
        <br><br>
    Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        <br><br>
        <br><br>
    <input type="submit" name="submit" value="Submit">
    </Form>

    <?php
    echo "<h2>Output:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $website;
    echo "<br>";
    echo $comment;
    ?>

    </Form>
    
</body>
</html>