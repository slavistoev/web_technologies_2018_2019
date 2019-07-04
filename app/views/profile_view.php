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
                <button onclick="showPanel(0)" class="active" >My profile:</button>
                <button onclick="showPanel(1)">My pixels:</button>
                <button onclick="showPanel(2)">Settings:</button>
            </div>
            <div class="tabPanel active">
                Tab 1: Content
            </div>  
            <div class="tabPanel">
                Tab 2: Content
            </div>  
            <div class="tabPanel">
                Tab 3: Content
            </div>  
            <div class="tab">
                Welcome To Your Profile!
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
</script>

</html>