<?php


namespace Todo\Controllers;

use Todo\Models\TaskManager;
use Todo\Validator;

class TaskController
{
    private $manager;
    private $validator;

    public function __construct() {
        $this->manager = new TaskManager();
        $this->validator = new Validator();
    }

    public function store() {
        if (!isset($_SESSION["user"]["username"])) {
            header("Location: /login");
            die();
        }
        $this->validator->validate([
            "nameTask"=>["required", "min:2", "alphaNumDash"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->find($_POST["nameTask"], $_SESSION['old']['list_id']);

            if (empty($res)) {
                $this->manager->store();
                header("Location: /dashboard/" . $_POST["nameList"]);
            } else {
                $_SESSION["error"]['nameTodo'] = "Le nom de la tache est déjà utilisé !";
                header("Location: /dashboard/" . $_POST["nameList"]);
            }
        } else {
            header("Location: /dashboard/".$_SESSION['old']['nameList']."/");
        }
    }

    public function update($slug) {
        if (!isset($_SESSION["user"]["username"])) {
            header("Location: /login");
            die();
        }
        $this->validator->validate([
            "nameTask"=>["required", "min:2", "alphaNumDash"]
        ]);
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            $res = $this->manager->find($_POST["nameTask"], $_SESSION['old']['idTodo']);

            if (empty($res) || $res->getName() == $slug) {
                $search = $this->manager->update($slug,$_SESSION['old']['idTodo']);
                header("Location: /dashboard/" . $_SESSION['old']['nameTodo']);
            } else {
                $_SESSION["error"]['nameTodo'] = "Le nom de la liste est déjà utilisé !";
                header("Location: /dashboard/" . $_SESSION['old']['nameTodo']);
            }

        } else {
            header("Location: /dashboard/" . $slug);
        }
    }

    public function delete($slug,$slug2)
    {
        if (!isset($_SESSION["user"]["username"])) {
            header("Location: /login");
            die();
        }
        $this->manager->delete($slug);
        header("Location: /dashboard/" . $slug2);
    }

    public function check($slug,$slug2)
    {
        if (!isset($_SESSION["user"]["username"])) {
            header("Location: /login");
            die();
        }
        $this->manager->check($slug);
        header("Location: /dashboard/" . $slug);
    }
}