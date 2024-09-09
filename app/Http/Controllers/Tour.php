<?php


namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Route;

class Tour extends Controller
{


    public function tour(){

        //if cookie is not set to false, then the tour will start

        if($this->get_save_status()=='false') {
            return "";
        }

        $route = Route::getFacadeRoot()->current()->uri();

        $sql = "SELECT * from tour where status = 'active' and url = '$route' order by seq asc " ;
        //echo @$sql;
        $tour = DB::select($sql);

        echo "<style>";
        echo ".tour .tour-arrow{
                    left: auto;
                }
        
        .dont-show-area{
            margin-bottom: 10px;
            border: solid 1px #4D4D4D;
            padding: 5px;
        }
                ";
        //echo $this->add_tour_style($tour);


        echo "</style>";

        echo "<script>";
        echo "const tour = new Tour(\"Welcome to ATS\");";
        echo $this->add_tour($tour);
        echo "tour.start();";
        echo "</script>";
    }

    private function add_tour_style($tour){
        $style = "";
        foreach ($tour as $t){
            $style .= $t->style;
        }

        return  $style;
    }
    private function add_tour($tour){
        $script ="";

        foreach ($tour as $t){
            $script .= "tour.addStep('$t->target-callout', {
                        title: \"$t->title\",
                        text: \"$t->content\",
                        hook: \"$t->target\",
                       // timer: 5000,
                        onShow: function() {
                            //position_tour(\"$t->target\");
                           
                        },
                        onHide: function() {
                            // Custom Function
                        },
                        buttons: [
                            {
                                text: \"Previous\",
                                action: \"tour.previous()\"
                            },
                            {
                                text: \"Next\",
                                action: \"tour.next()\"
                            },
                            {
                                class: \"btn btn-danger\", 
                                text: \"Exit\",
                                action: \"tour.stop()\"
                            }
                            
                        ],
                        links: [
                            {
                                text: \"\",
                                href: \"\"
                            }
                        ]
                    });             
            ";
        }

        return $script;
    }

    public function save_status(){
        $day = 86400; // 1 day
        setcookie('tour', $_GET['status'], time() + $day*365, "/");

        echo $this->get_save_status();
    }

    private function get_save_status(){
        if(isset($_COOKIE['tour'])){
            return $_COOKIE['tour'];
        }
    }
}