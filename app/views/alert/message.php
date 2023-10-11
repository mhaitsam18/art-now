<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'];?></title>
    <style>
        html, body {
            height: 99%;
        }
        body {
            display: flex; /* establish flex container */
            justify-content: center; /* center flex items horizontally, in this case */
            align-items: center; /* center flex items vertically, in this case */
        }
    </style>
</head>
<body>
    <p><?= $data['deskripsi'];?></p>
</body>
</html>