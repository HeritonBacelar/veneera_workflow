<?php include('template1.php'); ?>

<?php
include_once('dbConn.php');

if (isset($POST['submit'])) {
    $shopify_order = $_POST['shopify_order'];
    $rcl_date = $_POST['rcl_date'];
    $product = $_POST['product'];
    $issue = $_POST['issue'];
    $rcl_status = $_POST['rcl_status'];
    $info = $_POST['info'];
    $warranty = $_POST['warranty'];


}

?>

<div id="main-content">
    <a id="go-back-btn" href="read.php"><i class="fas fa-arrow-left"></i> Go Back</a>

    <div class="formtitle">

        <a href=""><img src="file.png" alt="Avatar" class="avataricon" value="teste"></a>

    </div>

    <form action="process_create.php" method="post">

        <label for="order">Shopify Order ID:</label>
        <input type="text" id="order" name="order" autocomplete="off" required>
        <input type="hidden" id="order_id" name="order_id">

        <label for="issue">Issue:</label>
        <select name="issue" required>
            <option value=""></option>
            <option value="1">Broken</option>
            <option value="2">Lost</option>
            <option value="3">Does not fit</option>
            <option value="4">Cancellation</option>
        </select><br>

        <label for="product">Product:</label>
        <select name="product" required>
            <option value=""></option>
            <option value="1">Impression set</option>
            <option value="2">Design fluid</option>
            <option value="3">Veneer Top</option>
            <option value="4">Veneer Bottom</option>
            <option value="5">Veneer Top and Bottom</option>
        </select><br>

        <label for="warranty">Warranty</label>
        <input type="number" id="warranty" name="warranty" required>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value=""></option>
            <option value="1">open</option>
            <option value="2">SC pending</option>
            <option value="3">closed</option>
        </select><br>



        <label for="info">Info:</label>
        <textarea id="info" name="info" rows="4"></textarea>

        <input class='send' type="submit" value="Insert Data">
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        aData = {};
        $("#order").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: 'http://localhost/veneera_workflow/autocomplete.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        aData = $.map(data, function (value, key) {
                            return {
                                label: value.order_name,
                                value: value.order_id, // Include order_id in the value
                            };
                        });
                        var results = $.ui.autocomplete.filter(aData, request.term);
                        response(results);
                    }
                });
            },
            select: function (event, ui) {
                // Set the selected order_id to the hidden input field
                $("#order_id").val(ui.item.value);
            }
        });
    </script>

</div>