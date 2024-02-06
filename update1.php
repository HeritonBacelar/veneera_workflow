<?php 
include('template1.php');
include_once('dbConn.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables with default values
$issue_id = $product_id = $status_id = $order_id = $info = $shopify_order = '';

if (isset($_GET['id'])) {
    $rcl_id = $_GET['id'];

    // Fetch the record to be updated
    $sql = "SELECT rcl_order.rcl_id, rcl_order.rcl_date, rcl_order.entry_date, rcl_order.Info, 
    shopify_order.order_name, product.product_name, issue.issue_name, rcl_status.status
    FROM rcl_order
    INNER JOIN shopify_order ON rcl_order.order_id = shopify_order.order_id
    INNER JOIN product ON rcl_order.product_id = product.product_id
    INNER JOIN issue ON rcl_order.issue_id = issue.issue_id
    INNER JOIN rcl_status ON rcl_order.status_id = rcl_status.status_id 
    WHERE rcl_id = $rcl_id";

    $result = $conn->query($sql);

    // Check if there are rows
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $issue_id = isset($row['issue_id']) ? $row['issue_id'] : '';
    $product_id = isset($row['product_id']) ? $row['product_id'] : '';
    $status_id = isset($row['status_id']) ? $row['status_id'] : '';
    $order_id = isset($row['order_id']) ? $row['order_id'] : '';
    $info = isset($row['Info']) ? $row['Info'] : '';
    $shopify_order = isset($row['order_name']) ? $row['order_name'] : '';
        // Start of the HTML block
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Data</title>
        </head>
        <body> 

        <div id="main-content">
            <a id="go-back-btn" href="read.php"><i class="fas fa-arrow-left"></i> Go Back</a>  
            <h2><?php echo $row['order_name']; ?></h2>

            <form action="" method="post">
                <label for="issue">Select Issue:</label>
                <select name="issue">
                <option value="1" <?php echo ($issue_id == 1) ? 'selected' : ''; ?>>Broken</option>
            <option value="2" <?php echo ($issue_id == 2) ? 'selected' : ''; ?>>Lost</option>
            <option value="3" <?php echo ($issue_id == 3) ? 'selected' : ''; ?>>Does not fit</option>
            <option value="4" <?php echo ($issue_id == 4) ? 'selected' : ''; ?>>Cancellation</option>
                </select><br>

                <label for="product">Select Product:</label>
                <select name="product">
                <option value="1" <?php echo ($product_id == 1) ? 'selected' : ''; ?>>Impression set</option>
            <option value="2" <?php echo ($product_id == 2) ? 'selected' : ''; ?>>Design fluid</option>
            <option value="3" <?php echo ($product_id == 3) ? 'selected' : ''; ?>>Veneer Top</option>
            <option value="4" <?php echo ($product_id == 4) ? 'selected' : ''; ?>>Veneer Bottom</option>
            <option value="5" <?php echo ($product_id == 5) ? 'selected' : ''; ?>>Veneer Top and Bottom</option>
                </select><br>

                <label for="status">Select Status:</label>
                <select name="status">
                <option value="1" <?php echo ($status_id == 1) ? 'selected' : ''; ?>>open</option>
            <option value="2" <?php echo ($status_id == 2) ? 'selected' : ''; ?>>SC pending</option>
            <option value="3" <?php echo ($status_id == 3) ? 'selected' : ''; ?>>closed</option>
                </select><br>

                <label for="order">Select Order:</label>
                <select name="order">
                <option value="1" <?php echo ($order_id == 1) ? 'selected' : ''; ?>>UK3032PN</option>
            <option value="2" <?php echo ($order_id == 2) ? 'selected' : ''; ?>>UK2538PH</option>
            <option value="3" <?php echo ($order_id == 3) ? 'selected' : ''; ?>>UK4564TN</option>
            <option value="4" <?php echo ($order_id == 4) ? 'selected' : ''; ?>>UK9090TH</option>
            <option value="5" <?php echo ($order_id == 5) ? 'selected' : ''; ?>>UK3032PN</option>
                </select><br> 

                <label for="info">Info:</label>
                <textarea id="info" name="info" rows="4"><?php echo $info; ?></textarea>

                <input type="submit" value="Update Data">
            </form>
        </div>

        </body>
        </html>
        <?php
        // End of the HTML block
    } else {
        echo "Record not found.";
        exit();
    } 
} else {
    echo "Invalid request. Please provide an ID.";
    exit();
}

// The rest of your PHP code goes here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated values from the form
    $new_issue_id = $_POST['issue'];
    $new_product_id = $_POST['product'];
    $new_status_id = $_POST['status'];
    $new_order_id = $_POST['order'];
    $new_info = $_POST['info'];

    // Update data in the rcl_order table
    $update_sql = "UPDATE rcl_order SET 
        issue_id = $new_issue_id,
        product_id = $new_product_id,
        status_id = $new_status_id,
        order_id = $new_order_id,
        Info = '$new_info'
        WHERE rcl_id = $rcl_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Data updated successfully."; 
        //header('Location:read.php');
    } else {
        echo "Error updating data: " . $conn->error;
    }
}
?>
