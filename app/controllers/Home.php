    <?php

class Home extends Controller{

    public function __construct(){}

    public function index(){
        session_start();
        $this->view("Home/index");
    }

    public function contact(){
        session_start();
        $this->view("Home/contact");
    }

    public function about(){
        session_start();
        $this->view("Home/about");
    }

    public function sites(){
        session_start();
        $this->view("Home/sites");
    }
}
