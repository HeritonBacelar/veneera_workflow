<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link href="/resources/demos/style.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      min-height: 100vh;
      background-color: #f4f4f4;
    }

    #sidebar {
      width: 200px;
      /* background-color:#0e7087; */
      background-color: #6c757d;
      color: #333;
      padding-top: 20px;
      transition: width 0.3s ease;
      position: fixed;
      /* Fixed Sidebar (stay in place on scroll) */
      z-index: 1;
      /* Stay on top */
      top: 0;
      /* Stay at the top */
      left: 0;
      bottom: 0;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border: 1px solid #ddd;

    }

    #sidebar a {
      text-decoration: none;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 10px 20px;
      transition: background 0.3s ease;
      font-weight: bold;
    }

    #sidebar a:hover {
      background-color: #555;
    }

    .avatar {
      /* vertical-align: middle; */
      width: 50px;
      height: 50px;
      border-radius: 50%;
      /*  display: flex; */
      /*  align-items: center; */
      padding: 2px 0px;
      /* transition: background 0.3s ease;  */
    }

    .avataricon {
      width: 50px;
      height: 50px;
      padding: 2px 0px;


    }

    #main-content {
      flex: 1;
      padding: 20px;
      transition: margin-left 0.3s ease;
      margin-left: 200px;
    }

    #search-bar {
      width: 100%;
      padding: 12px;
      box-sizing: border-box;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      background-color: #f5f5f5;
      font-size: 16px;
    }

    #data-table {
      width: 100%;
      border-collapse: collapse;
      /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
      background-color: #fff;
    }

    #data-table th,
    #data-table td {
      /* border: 1px solid #ddd; */
      padding: 12px;
      text-align: left;
      border-bottom: 1.5px solid #ddd;

    }

    #data-table th {
      /* background-color: #f2f2f2; */
      background-color: #fff;
      color: #333;
    }

    #data-table tr:hover {
      background-color: #f5f5f5;
    }

    #data-table td.actions {
      text-align: center;
    }

    #data-table i {
      cursor: pointer;
      color: #3498db;
    }

    .button {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      margin-right: 0px;
      margin-left: 0px;


    }


    /* Additional Styles for Improved Aesthetics */
    #sidebar a i {
      margin-right: 10px;
    }

    #sidebar a {
      display: flex;
      align-items: center;
      padding: 15px 20px;
    }

    #main-content {
      background-color: #fff;
      border-radius: 8px;
      /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
    }

    /* Additional Styles for the Add User Button */
    #add-user-btn {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-bottom: 20px;
      cursor: pointer;
      border-radius: 5px;
    }



    #filter-dropdown {
      float: right;
      margin-right: 2px;
      padding: 10px 20px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    /* Additional Styles for Form */
    form {
      max-width: 550px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      /* border-radius: 5px; */
      /* box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);   */
      /*  border: 1px solid #ddd;   */
      border-top: none;
    }

    .formtitle {
      height: 35px;
      max-width: 510px;
      margin: 0 auto;
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 5px;
      border: 1px solid #ddd;
      text-align: center;

      color: #6c757d;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);


    }


    form label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #6c757d;

    }

    form input,
    form select,
    form textarea {
      height: 54px;
      width: 100%;
      padding: 15px;
      margin-bottom: 15px;
      box-sizing: border-box;
      border: 1px solid #ddd;
      border-radius: 5px;
      /* border: 0px;  */
      background-color: #f8f9fa;
      font-size: 16px;
      /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #6c757d;
    }

    form input:hover,
    form select:hover,
    form textarea:hover,
    .formtitle:hover {
      transform: scale(1.009);
      box-shadow: 0px 0px 3px 0px #212529;
    }

    .send {
      width: 20%;
      background-color: #3498db;
      color: white;
    }

    form button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
      width: 100%;
    }

    /* Additional Styles for Go Back Button */
    #go-back-btn {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-bottom: 20px;
      cursor: pointer;
      border-radius: 5px;
    }


    .footer {
      position: fixed;
      padding: 5px;
      left: 0px;
      bottom: 0;
      width: 250px;
      background-color: none;
      color: white;
      text-align: left;
    }

    .status {
      border-radius: 5px;
      padding: 2px 4px;
      text-align: center;
    }

    .update {
      background-color: #3498db;
      color: #fff;

    }

    /* Accordion Styles */
    .accordion {
      background-color: #eee;
      color: #444;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
      transition: 0.4s;
    }

    .active,
    .accordion:hover {
      background-color: #ccc;
    }

    .panel {
      padding: 0 18px;
      display: none;
      background-color: white;
      overflow: hidden;
    }
  </style>
</head>

<body>

  <div id="sidebar">
    <a href=""><img src="img_avatar.png" alt="Avatar" class="avatar" value="teste"></a>

    <a href="read.php"><i class="fas fa-home"></i> All Orders</a>
    <a href="#"><i class="fas fa-chart-bar"></i> Analytics</a>
    <a href="catalog.php"><i class="fas fa-users"></i> Catalog</a>
    <a href="#"><i class="fas fa-cog"></i> Settings</a>

    <div class="footer">
      <p>

        User: Heriton

      </p>
    </div>

  </div>



</body>

</html>