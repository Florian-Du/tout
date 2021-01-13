<?php


namespace Todo\Models;

use Todo\Models\Task;
use Todo\Models\Todo;
class TaskManager
{
    private $bdd;

    public function __construct() {
        $this->bdd = new \PDO('mysql:host='.HOST.';dbname=' . DATABASE . ';charset=utf8;' , USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function find($name,$list_id)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM task WHERE nom = ? AND list_id = ?");
        $stmt->execute(array(
            $name,
            $list_id,
        ));
        $stmt->setFetchMode(\PDO::FETCH_CLASS,"Todo\Models\Todo");

        return $stmt->fetch();
    }

    public function store() {
        $stmt = $this->bdd->prepare("INSERT INTO task(nom, list_id, checkTask) VALUES (?, ?,0)");
        $stmt->execute(array(
            $_POST["nameTask"],
            $_POST["list_id"],
        ));
    }

    public function getAll($id)
    {
        $stmt = $this->bdd->prepare('SELECT * FROM task WHERE list_id = ?');
        $stmt->execute(array(
            $id
        ));

        return $stmt->fetchAll(\PDO::FETCH_CLASS,"Todo\Models\Task");
    }

    public function update($slug,$list_id) {
        $stmt = $this->bdd->prepare("UPDATE task SET nom = ? WHERE nom = ? AND list_id = ?");
        $stmt->execute(array(
            $_POST['nameTask'],
            $slug,
            $list_id
        ));
    }

    public function delete($slug) {

        $stmt = $this->bdd->prepare("DELETE FROM task WHERE id = ?");
        $stmt->execute(array(
            $slug
        ));
    }

    public function check($slug) {

        $stmt = $this->bdd->prepare("UPDATE task SET checkTask = ? WHERE id = ? AND list_id = ?");
        $stmt->execute(array(
            $_POST['check'],
            $_POST['idTask'],
            $_POST['idTodo']
        ));
    }
}