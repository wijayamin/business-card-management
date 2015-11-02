<?php
class Templating{
    public $template_param = array();
    public $rendered_template;
    public $app;
    public $req;
    public function __construct($app){
        $this->app = $app;
        $this->req = $app->request;
        $this->template_param["root_uri"]= str_ireplace('index.php', '', $this->req->getUrl().$this->req->getRootUri())."/";
        $this->template_param["root_path"]= str_ireplace('index.php', '', $this->req->getRootUri())."/";
    }
    public function prepare($html){
        $this->rendered_template=file_get_contents('application/view/'.$html, true);
    }

    public function param($parameter, $value){
        $this->template_param[$parameter]=$value;
    }

    public function execute(){
        $m = new Mustache_Engine();
        echo $m->render($this->rendered_template, $this->template_param);
        $this->template_param = array();
        $this->rendered_template;
        $this->app;
        $this->req;
    }

    public function render($html, $paramerer){
        $m = new Mustache_Engine();
        return $m->render(file_get_contents('application/view/'.$html, true), $paramerer);
    }
}
?>
