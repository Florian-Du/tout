<?php
// Code here...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
    <link rel="stylesheet" href="./Contenu/style.css">
    <script src="https://kit.fontawesome.com/c1d0ab37d6.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="bg-blue-500 text-white p-4 text-center">
        <h1>TO-DO List</h1>
    </header>

    <main class="text-gray-800">
       <section class="md:w-2/3 lg:w-1/3 mx-auto mt-4">
            <div class="add text-center p-2">
                <form>
                    <input type="text" name="todo" value="" class="border p-2 rounded" placeholder="Nouvel item">
                    <input type="submit" value="Ajouter" class="py-2 px-4 rounded bg-green-500 text-white">
                </form>
            </div>
            <table class="w-full mt-2">

            
                <tr class="border-t-2">
                    <td class="px-4 todo-item p-2">Une chose à faire</td>
                    <td class="hidden todo-input p-2">
                        <form action="traitement.php" method="post" class="text-center">
                            <input type="text" name="update" class="border p-2 rounded" value="Une chose à faire">
                            <input type="hidden" name="id" value="1">
                            <input type="submit" value="Changer" class="py-2 px-4 rounded bg-green-500 text-white"> 
                        </form>  
                    </td>
                    <td class="todo-actions text-center p-2 flex justify-center">
                        <button class="p-2 rounded bg-yellow-500 todo-update mr-4"><i class="fas fa-pen text-white"></i></button>
                        <form action="traitement.php" method="post">
                            <input type="hidden" name="delete" value="Une chose à faire">
                            <button class="p-2 rounded bg-red-500"><i class="fas fa-trash text-white"></i></button>
                        </form>
                    </td>
                </tr>
                
            </table>
       </section>
    </main>

    <script>
    let buttons = document.getElementsByClassName('todo-update')
    Array.from(buttons).map(function(element, index) {
        element.addEventListener('click', function() {
            document.getElementsByClassName('todo-item')[index].style.display = 'none'
            document.getElementsByClassName('todo-input')[index].style.display = 'block'
            document.getElementsByClassName('todo-actions')[index].style.display = 'none'
            
        })
    })


        
    </script>
</body>
</html>