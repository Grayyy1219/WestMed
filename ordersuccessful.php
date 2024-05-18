<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        #imeds {
            display: block;
            margin: 30px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            font-size: 24px;
            font-weight: bold;
            color: #1E9AFE;
            margin: 20px 0;
        }

        #home-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1E9AFE;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #home-link:hover {
            background-color: #1E9AFE;
        }
    </style>
</head>

<body>
    <img src="img/shopping.png" id="imeds" alt="Success" width="300" height="300">
    <div class="success-message">Successfully Ordered!</div>
    <a href="Landing page.php" id="home-link">Home</a>
</body>

</html>