<!DOCTYPE html>
<html>
    <body>
        <?php
            set_time_limit(1200);
            /*
                I don't really know how this works, but PDO is the name of the
                service we use to connect to the database. It's a free thing
                through PHP that did not require any downloads. Probably stands
                for "PHP Data Object." The passwords can be changed through
                CPanel, under "MySQL Databases."                                                        $pass, array(PDO::ATTR_TIMEOUT => 600)
            
            */
            $DB_HOST = "localhost";
            // $user = "uhocfelg_repstuart";
			$user = "user";
            // $pass = "}pX84%C3il!N";
			$pass = "pass";
            // $dbname = "uhocfelg_repstuartdb";
			$dbname = "rentals_db";
            function getPDO() {
    	        // Creates the pdo object holding the db connection
    	        global $user, $pass, $conn, $DB_HOST, $dbname;
    		    try {
    		        $conn = new PDO('mysql:host='.$DB_HOST.'; dbname='. $dbname.';charset=utf8', $user, $pass, array(PDO::ATTR_TIMEOUT => 1200));
    		        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $conn;
                } catch (PDOException $pe) {
                    die("Error connecting: " . $pe->getMessage());
                }
    	    }//end getPDO();
    	    getPDO();
        ?>
    </body>
</html>