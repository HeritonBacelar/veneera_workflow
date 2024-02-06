<?php include('template1.php'); ?>


<div id="main-content">

    <button id="add-user-btn" onclick="window.location.href='create.php'">Create Order</button>


    <select id="filter-dropdown" onchange="filterTable()">
        <option value="all">All Orders</option>
        <option value="closed">Status Closed</option>
        <option value="open">Status Open</option>
        <option value="SC pending">Status SC Pending</option>
    </select>

    <input type="text" id="search-bar" oninput="searchTable()">


    <?php

    include_once('dbConn.php');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from rcl_order table with related values
    $sql = "SELECT rcl_order.rcl_id, rcl_order.rcl_date, rcl_order.entry_date, rcl_order.Info, 
             shopify_order.order_name, rcl_order.warranty, product.product_name, issue.issue_name, rcl_status.status
      FROM rcl_order
      INNER JOIN shopify_order ON rcl_order.order_id = shopify_order.order_id
      INNER JOIN product ON rcl_order.product_id = product.product_id
      INNER JOIN issue ON rcl_order.issue_id = issue.issue_id
      INNER JOIN rcl_status ON rcl_order.status_id = rcl_status.status_id 
      ORDER BY rcl_id DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display data in HTML table
        echo "<table id='data-table'>";
        echo "<tr><th>ID</th><th>Date</th><th>Order</th><th>Warranty</th><th>Product</th><th>Issue</th><th>Status</th><th>Info</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $statusStyle = '';
            switch ($row['status']) {
                case 'SC pending':
                    $statusStyle = 'background-color: #ffc2d1;color: red;';
                    break;
                case 'open':
                    $statusStyle = 'background-color: #fcf6bd; color: #FFA447;';
                    break;
                case 'closed':
                    $statusStyle = 'background-color: #D9EDBF; color: green;';
                    break;
                // Add more cases as needed
            }

            $warrantyStyle = '';
            if ($row['warranty'] <= 14) {
                $warrantyStyle = 'background-color: #D9EDBF; color: green;';
            } else {
                $warrantyStyle = 'background-color: #ffc2d1;color: red;';
            }
            //$rowColor = ($row['status'] == 'SC pending') ? 'style="background-color: #FFB0B0;color: red"' : 'style="background-color: #D9EDBF; color: green;"';
            echo "<tr class='order-row' data-status='{$row['status']}'>";
            echo "<td style='color:#3498db;'>" . $row['rcl_id'] . "</td>";
            echo "<td>" . $row['rcl_date'] . "</td>";
            echo "<td><div class='status' style='$warrantyStyle'>" . $row['warranty'] . " days</div></td>";
            echo "<td>" . $row['order_name'] . "</td>";
            /* echo "<td>" . $row['warranty'] . "</td>"; */
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['issue_name'] . "</td>";
            echo "<td><div class='status' style='$statusStyle'>" . $row['status'] . "</div></td>";
            echo "<td>" . $row['Info'] . "</td>";
            echo '<td class="actions"> 
         
          <a href="update2.php?id=' . $row['rcl_id'] . '">
          <button class="button button4">Edit </button>
          </a> 
        
      </td>';
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    // Close connection
    $conn->close();



    ?>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search-bar");
            filter = input.value.toUpperCase();
            table = document.getElementById("data-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3]; // Assuming "Order Name" is the fourth column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


    <script>
        function filterTable() {
            var dropdown = document.getElementById("filter-dropdown");
            var selectedStatus = dropdown.value;

            var rows = document.getElementsByClassName("order-row");

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var rowStatus = row.getAttribute("data-status");

                if (selectedStatus === "all" || selectedStatus === rowStatus) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }

        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search-bar");
            filter = input.value.toUpperCase();
            table = document.getElementById("data-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3]; // Assuming "Order Name" is the fourth column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</div>