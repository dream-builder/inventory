<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Mockery\Exception;
use App\FileUploadModel;

class FileUpload extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('file_upload/fileupload');

        //return view('comments/commentsView_tags');
    }

    public function upload(Request $request){
        $destinationPath = 'uploads';
        $file = $request->file('file_to_upload');

        //Display File Name
        //echo 'File Name: '.$file->getClientOriginalName();
        //echo '<br>';

        //Display File Extension
        //echo 'File Extension: '.$file->getClientOriginalExtension();
       // echo '<br>';

        if($file->getClientOriginalExtension()!='jpg' && $file->getClientOriginalExtension()!='jpeg' && $file->getClientOriginalExtension()!='gif' &&
            $file->getClientOriginalExtension()!='bmp' && $file->getClientOriginalExtension()!='png' && $file->getClientOriginalExtension()!='pdf' ){

            echo "{
                        \"status\": \"error\",
                        \"msg\": \"Sorry! File format is not supported. Only PDF, JPG, PNG and GIF are supported.\"
                    }";
            return;
        }


        //Display File Real Path
        //echo 'File Real Path: '.$file->getRealPath();
        //echo '<br>';

        //File size more than 5MB will not upload

        //var_dump($file);

        if($file->getSize()>5242880){
            echo  $file->getSize();
            echo "{
                        \"status\": \"error\",
                        \"msg\": \"Sorry! file size must be lower than 5MB.\"
                    }";
            return;
        }



        //Display File Mime Type
       // echo 'File Mime Type: '.$file->getMimeType();


        //Generat file name
        $filename = Auth::id()."_".date("Ymdhis").".".$file->getClientOriginalExtension();

        $user_id = Auth::id();
        //echo '<br>';
        //echo $filename;



        $file->move($destinationPath,$filename);

        //Insert uploaded file information to DB
        $this->insert_file_info($filename,2,$user_id);

        echo "{
                        \"status\": \"success\",
                        \"file\": \"$filename\"
                    }";



    }

    public function remove_user_file(){
        $file = 'uploads/'.$_GET['file'];
        
        try{

            if(file_exists (  $file )) {
                unlink($file);
            }

            echo "{
                        \"status\": \"success\",
                        \"msg\": \"\"
                    }";

        }
        catch (Exception $e){
            echo "{
                        \"status\": \"error\",
                        \"msg\": \"Sorry! Can't remove file.\"
                    }";
        }

    }

    public function insert_file_info($upload_file,$issue_id = null, $user_id = null){
            try{
                $file = new FileUploadModel();
                $file->issue_id =$issue_id;
                $file->user_id = $user_id; //Logged in USer
                $file->file_name = $upload_file;
                $file->save();
            }
            catch (Exception $e){
            }
    }
}