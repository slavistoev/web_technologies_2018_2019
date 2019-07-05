<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>

    <style>
        <?php 
           $path = $_SERVER['DOCUMENT_ROOT'];
           $path .= "/web_technologies_2018_2019/public/css/profile_style.css";
           include($path);
        ?>
    </style>

    
</head>

<body>
    <nav>
        <a href="./home" ><img src="./images/pixel-logo.png" class="logo" alt="logo"></a>
        
        <?php
        if ($_SESSION) {
            if($_SESSION["username"]) {
               echo '<a href="./logout" class="button3">Logout</a>
                   <a href="./profile" class="button3">Profile</a>';
            } else {
                echo "<p>Error username</p>";
            }
        }
        ?>
    </nav>
    <article>
        <div class="tabContainer">
            <div class="buttonContainer">
                <button onclick="showPanel(0)" class="active" >My profile</button>
                <button onclick="showPanel(1)">See my pixels</button>
                <button onclick="showPanel(2)">Settings</button>
            </div>
            <div class="tabPanel">
                <?php
                    if ($_SESSION) {
                        $username = $_SESSION["username"];
                        if(isset($username)){ 
                            try {
                                // $dir = dirname(dirname(__FILE__));
                                // include_once $dir . '\models\database.php';
                                // $vars = $dir . '\include\vars.php';
                            
                                $db = new Database;
                                $pdo = $db->connect();
                            } catch (Exception $e) {
                                echo $e->getTraceAsString();
                            }
                
                            $sql = "SELECT * FROM users WHERE username='$username'";
                            $q = $pdo->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            if ($r = $q->fetch()) {
                                if($r['img'] == null || !file_exists('../public/images/profilePics/' . $r['img'])) {
                                    echo '<img src="../public/images/profilePics/empty.png" class="profilePic"/>';
                                }
                                else {
                                    echo '<img src="../public/images/profilePics/' . $r['img'] . '" class="profilePic"/>';
                                }
                                echo '<div class="info"> <div> Username: <span class="italic">' . $r['username'] . '</span></div>';
                                echo '<div>Email: <span class="italic">' . $r['email']. '</span></div>';
                                if ($r['first_name'] != null) {
                                    echo '<div>First Name: <span class="italic">' . $r['first_name']. '</span></div>';
                                } else {
                                    echo '<div>First Name: <span class="italic">Unknown</span></div>';
                                }

                                if ($r['last_name'] != null) {
                                    echo '<div>Last Name: <span class="italic">' . $r['last_name']. '</span></div></div>';
                                } else {
                                    echo '<div>Last Name: <span class="italic">Unknown</span></div></div>';
                                }
                                
                                
                            }
                        }
                    } 
                ?>
            </div>  
            <div class="tabPanel" id="pixelChange">
            <table>
                <?php
                    $sql = "SELECT * FROM grid WHERE owner='$username'";
                    $q = $pdo->query($sql);
                    $q->setFetchMode(PDO::FETCH_ASSOC);
                    
                    while ($r = $q->fetch()) {
                        echo '<tr><th><div class="pixel"><div class="image"> <a href="' . $r['link'] . '" class="cell" target="_blank"><img src="../public/images/' . $r['img'] . '" title="' . $r['text'] . '"/>'. '</a></div></th>';
                        echo '<th><div class="text"><a href="#" class="button-p" id="' . $r['id'] . '" onClick="reply_click_to_delete(this.id)">Delete</a></div></th>';
                        echo '<th><div class="text"><a href="#" class="button-p" id="' . $r['id'] . '" onClick="reply_click_to_change(this.id)">Change</a></div></div></th></tr>';
                    }
                ?>
            </table>
            </div>
            <div class="tabPanel">
                
                <form method="POST" action="./changePass" class="changeInfo">
                    <legend>Change password:</legend>
                    <div><input type="password" id="passwordOld" name="passwordOld" placeholder="Old password">
                    <input type="password" id="passwordNew" name="passwordNew" placeholder="New password">
                    <input type="password" id="passwordNewS" name="passwordNewS" placeholder="Repeat new Password"></div>
                    <div><input type="submit" name="submit" class="button" value="Submit"></div>
                </form>

                <form method="POST" action="./changeInfo" class="changeInfo" enctype="multipart/form-data">
                    <legend>Change your info:</legend>
                    
                    <div><input type="text" id="firstname" name="firstname" placeholder="First Name">
                    <input type="text" id="lastname" name="lastname" placeholder="Last Name"></div>
                    <div><input type="file" name="img" id="img" class="inputfile">
                    <input type="submit" name="submit" class="button" value="Submit"><div>
                </form>
            </div>
        </div>
    </article>
</body>

<script language="javascript" type="text/javascript">
    var tabButtons=document.querySelectorAll(".tabContainer .buttonContainer button");
    var tabPanels=document.querySelectorAll(".tabContainer .tabPanel");

    tabPanels[0].style.display="block";
    tabButtons[0].style.backgroundColor="#99989869";
    tabButtons[0].style.color="white";

    function showPanel(panelIndex) {
        tabButtons.forEach(function(node) {
            node.style.backgroundColor="";
            node.style.color="";
        });
        tabButtons[panelIndex].style.backgroundColor="#99989869";
        tabButtons[panelIndex].style.color="white";

        tabPanels.forEach(function(node) {
            node.style.display="none";
        })
        tabPanels[panelIndex].style.display="block";
        
        tabPanels[panelIndex].style.backgroundColor="#99989869";

    }

    function reply_click_to_delete(clicked_id) {
        window.location.href = "./delete?id=" + clicked_id; 
    };

    function reply_click_to_change(clicked_id) {
        window.location.href = "./change?id=" + clicked_id; 
    };
</script>

</html>