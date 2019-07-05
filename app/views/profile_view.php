<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel.com</title>

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
                                $dir = dirname(dirname(__FILE__));
                                include_once $dir . '\models\database.php';
                                $vars = $dir . '\include\vars.php';
                            
                                $db = new Database;
                                $pdo = $db->connect($vars);
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
                                    echo '<div>Last Name: <span class="italic">' . $r['last_name']. '</span></div>';
                                } else {
                                    echo '<div>Last Name: <span class="italic">Unknown</span></div></div>';
                                }
                                
                                
                            }
                        }
                    } 
                ?>
            </div>  
            <div class="tabPanel" id="pixelChange">
                <?php
                    $sql = "SELECT * FROM grid WHERE owner='$username'";
                    $q = $pdo->query($sql);
                    $q->setFetchMode(PDO::FETCH_ASSOC);
                    
                    while ($r = $q->fetch()) {
                        echo '<div class="pixel"><div class="image"> <a href="' . $r['link'] . '" class="cell" target="_blank"><img src="../public/images/' . $r['img'] . '" title="' . $r['text'] . '"/>'. '</a></div>';
                        echo '<div class="text"><a href="#" class="button" id="' . $r['id'] . '" onClick="reply_click_to_delete(this.id)">Delete</a></div>';
                        echo '<div class="text"><a href="#" class="button" id="' . $r['id'] . '" onClick="reply_click_to_change(this.id)">Change</a></div></div>';
                    }
                ?>
            </div>  
            <div class="tabPanel">
                Tab 3: Content
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