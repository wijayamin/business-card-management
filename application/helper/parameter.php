<?php
class parameter{
    public $app;
    public $template;
    public $db;
    public $users;
    public $groups;
    public $mail;
    public $req;
    public function __construct($app, $template, $db, $users, $groups, $mail){
        $this->app = $app;
        $this->template = $template;
        $this->db = $db;
        $this->users = $users;
        $this->groups = $groups;
        $this->mail = $mail;
        $this->req = $app->request;
    }
}
?>
