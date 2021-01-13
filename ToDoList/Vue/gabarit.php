<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="Contenu/style.css" />
        <title><?php echo $titre ?></title>
    </head>
    <body>
        <div id="global">
            <header class="bg-blue-500 text-white p-4 text-center">
                <a href="index.php"><h1 id="titreBlog">ToDoList</h1></a>
                <p>Je vous souhaite la bienvenue sur cet ToDoList</p>
                <h2><?php echo $titre ?></h2>
              
            </header>
            <div id="contenu">
                <?php echo $contenu ?>
            </div> <!-- #contenu -->
            <footer class="px-4 todo-item p-2" id="piedBlog">
                Blog réalisé avec PHP, HTML5 et CSS.
            </footer>
        </div> <!-- #global -->
    </body>
</html>