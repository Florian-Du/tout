<?php


class config_manager
{
    // variables
    private object $config;
    private string $language;

    // constructor
    public function __construct()
    {
        if (isset($_SESSION['langue'])){
            $this->language = $_SESSION['langue'];
        }else {
            $this->language = 'FR';
            $_SESSION['langue'] = 'FR';
        }
        $json = file_get_contents("./config.json");
        $fichier = json_decode($json);
        $this->config = $fichier;
    }

    //accesseur
    public function getconfig() :object{
        return $this->config;
    }
    public function setconfig($config) :void {
        $this->config = $config;
    }
    public function getLanguage() :string{
        return $this->language;
    }
    public function setLanguage($langue) :void {
        $this->language = $langue;
    }
    //method


}