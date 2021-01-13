<?php


namespace Todo\Models;


class Task
{
    private Int $id;
    private String $nom;
    private Int $list_id;
    private String $checkTask;

    public function getId() :int {
        return $this->id;
    }

    public function getName() :string{
        return $this->nom;
    }

    public function getListId() :int {
        return $this->list_id;
    }

    public function getCheckTask() :string {
        return $this->checkTask;
    }

    public function setId(Int $id) {
        $this->id = $id;
    }

    public function setName(String $name) {
        $this->nom = $name;
    }

    public function setListId(Int $ListId) {
        $this->list_id = $ListId;
    }

    public function setCheckTask(String $checkTask) {
        $this->checkTask = $checkTask;
    }
}