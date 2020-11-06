<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Exercice avec REQUEST</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <SCRIPT language="JAVASCRIPT">
            function envoyer_formulaire() {
                //appelle la page recoit_post.php avec transmission des variables dans l'URL
                document.location.href="recoit_post.php?nom="+document.formulaire.nom.value+"&prenom="+document.formulaire.prenom.value;
            } 
        </SCRIPT>
    </head>
    <body>
        <form action="lesrequettes.php" method="POST" name="formulaire">
            <h2>Formulaire d'envoi du prénom et du nom</h2>
            Prénom: <input type="text" name="prenom" /><br /><br />
            Nom: <input type="text" name="nom" /><br /><br />
            <input type="submit" name="envoyerPOST" value="envoyer par POST" /> 
            <input type="button" name="envoyerGET" value="envoyer par GET" onClick="envoyer_formulaire()"/>
        </form>
    </body>
</html>