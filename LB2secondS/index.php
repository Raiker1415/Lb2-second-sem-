<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <title>Games</title>
</head>
<body>


    <h2>Таблиця чемпіонату для обраної ліги</h2>
    <form action="SheetOfChampion.php" method="post">
        <select name="champions">
            <?php
            include("connect.php");
            require_once("connect.php");
            $collections = (new MongoDB\Client)->LB2secondS->gameChampions;
            $leagues = $collections->distinct('league');
          foreach($leagues as $league){
             echo '<option value = "' .$league. '">' .$league . '</option>';
         }
        ?>
        </select>
            <input type="submit" value="Результат">       
    </form>


    <h2>Список футболістів зазначеної команди</h2>
<form action="MembersOfSquad.php" method="post">
    <select name="squad">
        <?php
        include("connect.php");
        require_once("connect.php");
        $collections = (new MongoDB\Client)->LB2secondS->gameCommands;
        $names = $collections->distinct('name');
        foreach($names as $name){
            echo '<option value="' . $name . '">' . $name . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Результат">
</form>


<h2>Список ігор, у яких брала участь обрана команда</h2>
<form action="ListOfGames.php" method="post">
    <select name="squad">
        <?php
        include("connect.php");
        
        $collectionsChampions = (new MongoDB\Client)->LB2secondS->gameChampions;
        $collectionsCommands = (new MongoDB\Client)->LB2secondS->gameCommands;
        
        $namesChampions = $collectionsChampions->distinct('teams');
        $namesCommands = $collectionsCommands->distinct('name');
        
        $names = array_unique(array_merge($namesChampions, $namesCommands));
        
        foreach ($names as $name) {
            echo '<option value="' . $name . '">' . $name . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Результат">
</form>



<script>
    const data = localStorage.getItem("request");
    const result = JSON.parse(data);
    if (result.length > 0) {
        const uniqueElements = [...new Set(result)];
        let output = "";
        uniqueElements.forEach(function(element){
            output += " " + element;
        });
        document.write("Попередній запит:" + output);
    }
</script>

</body>
</html>