<?php
session_start();
if (isset($_POST["Identifiant"]) && isset($_POST["passeword"])) {
    if ($_POST["Identifiant"] == "Dupont" && $_POST["passeword"] == "alibaba") {
        session_destroy();
        echo "Login Correct";
    }else {

        $tableauIdentifiant = array();
        $tableauPasseword = array();
        if (isset($_SESSION['identifiant']) && isset($_SESSION['passeword'])) {
            for ($i=0; $i < count($_SESSION['identifiant']); $i++) { 
                array_push($tableauIdentifiant,$_SESSION['identifiant'][$i]);
                array_push($tableauPasseword,$_SESSION['passeword'][$i]);
            }
        }
        array_push($tableauIdentifiant,$_POST['Identifiant']);
        array_push($tableauPasseword,$_POST['passeword']);
        $_SESSION['identifiant'] = $tableauIdentifiant;
        $_SESSION['passeword'] = $tableauPasseword;

        header("Location:./login.php?Identifiant=incorrect"); 
    }
}else {
    echo "<p> erreur </p>";
}
?>
