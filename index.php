<!DOCTYPE html>
<html>
 <head>
 <title> Runtrack PHP - Jour 7</title>
 <meta name="viewport" content="width=device-width, initial-scale=0.5">

 </head>
 <body>

 <style> 

p {
    text-align : center;
    font-size : 30px;
}

.container{
    background-color : darkslateblue;
    width : 400px;
    height : 400px;
    display : flex;
    flex-direction :row;
    justify-content : center;
    align-items: start;
    padding : 20px;
}

body{
    display : flex;
    flex-direction :row;
    justify-content : center;
    align-items: start;
    gap : 20px;
}

.game{
    display : flex;
    flex-direction :column;
    justify-content : center;
    align-items: center;
    gap : 20px;
}

.container1{
    width : 100%;
    height : 100px;
    display : flex;
    flex-direction :row;
    justify-content : center;
    align-items: center;
}

.socle{
    display : flex ; 
    flex-direction : row;
    justify-content: end;
    align-items : end;
    height : 400px;
    width : 200px;
    margin-right : -50px;
    margin-left : -90px;
}

.base{
    width : 20px;
    height : 15px;
    background-color : white;  
}

.traverse{
    display : flex;
    flex-direction :row;
}

.brick{
    width : 20px;
    height : 40px;
    background-color : white;   
}

.brick2{
    width : 20px;
    height : 20px;
    background-color : white;   
}

.tête{
    width : 40px;
    height : 40px;
    background-color : white;  
    border-radius : 1100px;
    margin-left :-8px;
    margin-top: 10px;  
}

.tronc{
    display : flex ; 
    flex-direction : row;
    gap : 6px;
    margin-left : -25px;
}

.one{
    width : 10px; 
}

.two{
    width : 40px; 
}

.three{
    width : 10px; 
}

.thorax{
    width : 40px;
    height : 100px;
    background-color : white;  
    border-radius : 90px;
    margin-top: 10px;  
}

.arm1{
    width : 10px;
    height : 70px;
    background-color : white;  
    border-radius : 90px;
    margin-top: 20px;  
}

.arm2{
    width : 10px;
    height : 70px;
    background-color : white;  
    border-radius : 90px;
    margin-top: 20px;  

}

.legs{
    display : flex ; 
    flex-direction : row;
    gap : 15px;
}

.leg1{
    width : 15px;
    height : 90px;
    background-color : white;  
    border-radius : 90px;
    margin-left :-8px;
    margin-top: 10px;  
}

.leg2{
    width : 15px;
    height : 90px;
    background-color : white;  
    border-radius : 90px;
    margin-left :-8px;
    margin-top: 10px;  
}

.text{
    width : 440px;
    height : 70px;
    background-color : darkslateblue;
    display : flex;
    flex-direction : row;
    justify-content : center;
    align-items : center;
    gap : 10px;
}

.newgame{
    width : 440px;
    height : 70px;
    background-color : darkslateblue;
    display : flex;
    flex-direction : row;
    justify-content : center;
    align-items : center;
    gap : 10px;
    margin-top: 30px;
}

.newgame input{
    padding : 7px;
    background-color : white;
    font-family : monospace;
    border:none;
    font-size : 20px;
}

.text input{
    width : 30px;
    height : 30px;
    text-align :center;
}
</style>

<?php 

session_start();

// __________ declare WORDS __________ //

$_SESSION["words"]=["CRABE","CRAYON","ARAIGNEE","TOURNEVIS","OLIVE"];

// __________ define current WORD __________ //

if(!isset($_SESSION["display"])){
    $_SESSION["Cword"] = str_split($_SESSION["words"][array_rand($_SESSION["words"],1)]);
    foreach($_SESSION["Cword"] as $word){
        $_SESSION["display"][]="";
    }
}

// __________Compare INPUT with WORD __________ //

if(isset($_POST["letter"])){
    $i = 0;
    $OK = false;
    foreach($_SESSION["Cword"] as $wletter){
        if(strtoupper($_POST["letter"]) == $wletter){
            $_SESSION["display"][$i] = $wletter;
            $OK = true;
        }
        $i++;
    }
    if($OK==false){
        $_SESSION["erreur"]++;
    }
}

if($_SESSION['erreur']==6){
    $_SESSION["display"]=$_SESSION["Cword"];
}

// __________Restart session for NEWGAME __________ //

if(isset($_POST["newgame"])||$_SESSION["erreur"] >6){
    session_destroy();
    header('Location:hangman.php');
}

?>
<div class="TTC">  <div class='newgame'> 
    <form method ="post" action="ttc.php">   
        <input type='submit' value='TIC TAC TOE' name='newgame'> </input> 
    </form>   
</div> </div>

<div class="game">
<div class='newgame'> 
    <form method ="post">   
        <input type='submit' value='NEW GAME' name='newgame'> </input> 
    </form>   
</div>
<div class='text'> 
    <form method ="post">
        <input type='text' name='letter' id ='letter'>  </input> 
    </form>   
</div>

<div class ="container">
    <div class ="socle">
        <div class="base"> </div>
        <div class="base"> </div>
        <div class="base"> </div>
        <div class="base"> </div>
    </div>
    <div class ="poteau">
        <div class="brick"> </div>
        <div class="brick"> </div>
        <div class="brick"> </div>
        <div class="brick"> </div>
        <div class="brick"> </div>
        <div class="brick"> </div>
        <div class="brick"> </div>
        <div class="brick"> </div>
        <div class="brick"> </div>
        <div class="brick"> </div>
    </div>
    <div class ="traverse">
        <div class="brick2"> </div>
        <div class="brick2"> </div>
        <div class="brick2"> </div>
        <div class="brick2"> </div>
        <div class="brick2"> </div>
        <div class="brick2"> </div>
        <div class="brick2"> </div>
        <div class="brick2"> </div>
        <div class="brick2"> </div>
        <div class="brick2"> </div>
    </div>
    <div class ="poteau">
        <div class="brick"> </div>
        <div class="brick"> </div>
        <?php 
        if($_SESSION['erreur']==1 || $_SESSION['erreur']==2 ||  $_SESSION['erreur']==3 ||  $_SESSION['erreur']==4 ||  $_SESSION['erreur']==5 ||  $_SESSION['erreur']==6){
            echo "<div class='tête'> </div>";}
            ?>
        <div class="tronc"> 
            <div class="one">
            <?php 
        if($_SESSION['erreur']==2 ||  $_SESSION['erreur']==3 ||  $_SESSION['erreur']==4 ||  $_SESSION['erreur']==5 ||  $_SESSION['erreur']==6){
            echo "<div class='arm1'> </div>";}
            ?>            </div> 
            <div class="two">
            <?php 
        if($_SESSION['erreur']==3 ||  $_SESSION['erreur']==4 ||  $_SESSION['erreur']==5 ||  $_SESSION['erreur']==6){
            echo "<div class='thorax'> </div>";}
            ?>            </div> 
            <div class="three">
            <?php 
        if($_SESSION['erreur']==4 ||  $_SESSION['erreur']==5 ||  $_SESSION['erreur']==6){
            echo "<div class='arm2'> </div>";}
            ?>            </div> 
        </div>
        <div class="legs">         
        <?php 
        if($_SESSION['erreur']==5||  $_SESSION['erreur']==6){
            echo "<div class='leg1'> </div>";}
        if($_SESSION['erreur']==6){
            echo "<div class='leg2'> </div>";}
            ?>        
        </div>
    </div>

</div>

<?php
// $_SESSION["words"]=["CRABE","CRAYON","ARAIGNEE","TOURNEVIS","OLIVE"];
// $w = str_split($_SESSION["words"][array_rand($_SESSION["words"],1)]);
$i = 0;

echo "<div class='text'> ";

foreach($_SESSION["Cword"] as $word){
    $_SESSION["display"][]="";
    $val = $_SESSION["display"][$i];
    echo "<input maxlength = '1' type='text' name='1L' value=$val> </input>";
    $i++;
}
echo "</div>";

?>

<!-- <div class='text'> 
    <input type='text' name='1L' value= <?php echo $_SESSION["display"][0]?>>  </input> 
    <input type='text' name='2L' value= <?php echo $_SESSION["display"][1]?>>  </input>   
    <input type='text' name='3L' value= <?php echo $_SESSION["display"][2]?>>  </input>   
    <input type='text' name='4L' value= <?php echo $_SESSION["display"][3]?>>  </input>   
    <input type='text' name='5L' value= <?php echo $_SESSION["display"][4]?>>  </input>     
</div> -->

</div>

<div class="memory">  <div class='newgame'> 
    <form method ="post" action="memory.php">   
        <input type='submit' value='MEMORY' name='newgame'> </input> 
    </form>   
</div> </div>

</body>
</html>