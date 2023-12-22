<?php
include ('./connect.php');

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $image = $_FILES['file'];


    $imageName = $image['name'];
    $imageFileTemp = $image['tmp_name'];
    $filename_seperate = explode('.', $imageName);

    echo "<br>";
    $file_extension = strtolower(end($filename_seperate));

    $extensions = array('jpeg', 'png', 'jpg', 'pdf');
    if(in_array($file_extension, $extensions)){
        $upload_image = 'images/'. $imageName;
        move_uploaded_file($imageFileTemp, $upload_image);
        $stmt = $conn->prepare('INSERT INTO registration (name, mobile,image) VALUES (?,?,?)');
        $stmt->bind_param('sss', $username, $mobile, $upload_image);
        $result = $stmt->execute();

        if($result){
            header('location:display.php');
        }

    }else{
        echo "File extension not accepted";
    }
}

$stmt = $conn->prepare('SELECT * FROM registration');
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <table border='1' cellpadding='30'>
        <?php
        if($result->num_rows > 0){
        ?>
        <tr>
            <td>Name</td>
            <td>Mobile</td>
            <td>Image</td>
        </tr>
        <?php
        while($rows = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?= $rows['name'];?></td>
            <td><?= $rows['mobile'];?></td>
            <td><img src="<?= $rows['image'];?>" alt="<?= $rows['name'];?>"></td>
        </tr>
        <?php
        }
    }else{
        echo '<tr colspan="3">No Data found</tr>';
    }
        ?>
    </table>
</body>
</html>