        <?php 


        $servername = 'localhost';
        $dbname = 'Api_Login_IG';
        $username = 'root';
        $password = '';
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed");
            
        }

        ?>