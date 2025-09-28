<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Gallery</title>

    <!--<style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            margin-top: 16px;
        }
        input[type="text"], input[type="email"], textarea, input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 16px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>-->
    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    form {
      max-width: 300px;
      margin: 50px auto;
      padding: 20px;
      background-color: #f2f2f2;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input[type="text"],input[type="email"], textarea, input[type="file"]  {
      width: 93%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      background-color:  #86B817;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #86B817;
    }
  </style>
</head>
<body>

        <form method="post" action="upload.php" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="spot">Spot:</label>
        <input type="text" id="spot" name="spot" required>
        
        <label for="review">Review:</label>
        <textarea id="review" name="review" required></textarea>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required>
      

   <input type="submit" name="submit" value="Upload" />

    </form>

</body>
</html>
