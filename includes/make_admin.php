<?php
require('pdocon.php');

session_start();
        $db = new Pdocon;

            if(isset($_POST['user_id']))
            {
                $user_Id = $_POST['user_id'];
                $db->query('SELECT * FROM fsc_Users WHERE user_Id=:user_Id');
                $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
                $row = $db->fetchSingle();
                
                $user_Id = $_POST['user_id'];
                $db->query('SELECT * FROM admin WHERE user_Id=:user_Id');
                $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
                $rowAdmin = $db->fetchSingle();
                
                if($rowAdmin)
                {
                    echo '<div class="alert alert-danger text-center" style="font-family: Oswald, sans-serif;
                    font-weight:300;">
                    <a href="view_users.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $row['first_Name'] . " " . $row['last_Name'] . ' is already an administrator.
                        </div>';
                
            } else {
                     $db->query("INSERT INTO admin(admin_Id, user_Id) VALUES(NULL, :user_Id)");
           
                    $db->bindvalue(':user_Id', $user_Id, PDO::PARAM_INT);
           
                    $run = $db->execute();
            
                    if($run)
                    {
                      echo '<div class="alert alert-success text-center" style="font-family: Oswald, sans-serif;
                    font-weight:300;">
                            <a href="view_users.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            User: ' . $row['first_Name'] . " " . $row['last_Name'] . ' promoted to administrator.
                                </div>';
                    
                } else {
                      
                }
            }
        }
?>