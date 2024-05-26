<?php session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /HighSchoolPrints/login/index.php?next=order");
    exit();
} else {
    $_user_id = $_SESSION['user_id'];

    $_size_single = $_POST['size_single'];
    $_qty_single = $_POST['qty_single'];

    $_size_group = $_POST['size_group'];
    $_qty_group = $_POST['qty_group'];

    $_dbuser = "root";
    $_dbpass = "root";
    $_dbhost = "localhost";
    $_dbname = "HSPrintsDB";
    $_conn = mysqli_connect($_dbhost, $_dbuser, $_dbpass, $_dbname);
    if (!$_conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $_query = <<<EOF
            INSERT INTO Orders(Date, TotalPrice, Student)
            VALUES (NOW(), '0', '$_user_id');
        EOF;
        $_result = mysqli_query($_conn, $_query);


        $_query = <<<EOF
            SELECT MAX(ID) 
            FROM Orders;
        EOF;
        $_result = mysqli_query($_conn, $_query);
        $_row = mysqli_fetch_row($_result);
        $_order_id = $_row[0];


        if ($_qty_single > 0) {
            $_query = <<<EOF
                INSERT INTO Prints (ProductID, Format, OrderID, Quantity, Price) 
                VALUES ('1', '$_size_single', $_order_id, '$_qty_single', ((
                                                SELECT PricePerUnit 
                                                FROM PaperFormat 
                                                WHERE Name='$_size_single'
                                            ) * $_qty_single)
                                        );
            EOF;

            $_result = mysqli_query($_conn, $_query);
        }

        if ($_qty_group > 0) {
            $_query = <<<EOF
                INSERT INTO Prints (ProductID, Format, OrderID, Quantity, Price) 
                VALUES ('2', '$_size_group', $_order_id, '$_qty_group', ((
                                                SELECT PricePerUnit 
                                                FROM PaperFormat 
                                                WHERE Name='$_size_group'
                                            ) * $_qty_group)
                                        );
            EOF;

            $_result = mysqli_query($_conn, $_query);
        }

        $_query = <<<EOF
            SELECT SUM(Price) 
            FROM Prints 
            WHERE OrderID=$_order_id;
        EOF;
        $_result = mysqli_query($_conn, $_query);
        $_row = mysqli_fetch_row($_result);
        $_total_price = $_row[0];

        $_query = <<<EOF
            UPDATE Orders
            SET TotalPrice=$_total_price
            WHERE ID=$_order_id;
        EOF;
        $_result = mysqli_query($_conn, $_query);
        $_SESSION['order_id'] = $_order_id;

        if ($_result) {
            header("Location: /HighSchoolPrints/order/order_success.php");
            exit();
        } else {
            echo "Error: " . $_query . "<br>" . mysqli_error($_conn);
        }

        mysqli_close($_conn);
    }
}
