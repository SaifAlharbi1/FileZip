

<?php

use PhpParser\Node\Stmt\Echo_;


class openZip {

    public $countFile; // عدد الملفات المضغوطة
    public $folderPath = 'C:\Users\saifa\Downloads\*.zip';
    public $get_file ; // اسماء الملفات المضغوطة
   
    static public $class_zip; // get class ZipArchive

    function __construct($name)
    {
       self::$class_zip = $name;
    }
    

   public function count_files(){

        $get_name_folder_zip = new GlobIterator($this->folderPath);
        $this->countFile =  $get_name_folder_zip->count();
        $this->get_file = $get_name_folder_zip;
    }

    function openZip(){

       
        if($this->countFile > 0){
            foreach($this->get_file as $name_folder) { 
                if (self::$class_zip->open($name_folder) === TRUE) {

                    $del_zip = chop($name_folder , ".zip"); // لازالة .zip من اسم المجلد

                        if(self::$class_zip->extractTo($del_zip) === TRUE) {

                            echo "<div class='box' ><strong>تم فتح ضغط الملف بنجاح</strong>"; 

                            echo " <p class='nameFile'> " . $del_zip .  "</p> </div>" ;
            
                            for($i = 0; $i <= self::$class_zip->numFiles; $i++) {

                                self::$class_zip->deleteIndex($i);  // لحذف الملفات بالمجلد
                            }
                            // لحذف المجلد يجب ان يكون فارغ
                        } 
                    }else {
                        echo "لايوجد ملف مضغوط";
                    }
            
            }
        }
        else{
            echo "<div class='box no_file'>لاتوجد ملفات مضغوطة </div>" ;
        }
    }


    function openZaipWathoutDelete()
    {
        if($this->countFile > 0){
            foreach($this->get_file as $name_folder) { 
                if (self::$class_zip->open($name_folder) === TRUE) {

                    $del_zip = chop($name_folder , ".zip"); // لازالة .zip من اسم المجلد
                        if(self::$class_zip->extractTo($del_zip) === TRUE) {

                            echo "<div class='box' ><strong>تم فتح ضغط الملف بنجاح</strong>"; 
                            echo " <p class='nameFile'> " . $del_zip .  "</p> </div>" ;

                        } 
                    }else {
                        echo "لايوجد ملف مضغوط";
                    }
            
            }
        }
        else{
            echo "<div class='box no_file'>لاتوجد ملفات مضغوطة </div>" ;
        }

    }





    function openZip_chos()
    {
        
        $chen_arr = explode("," , $_GET['chos_file']);

        $this->countFile = count($chen_arr);

        // echo  $this->countFile;
        if($this->countFile > 0 ){
            foreach($chen_arr as $name_folder) { 
                if(!empty($name_folder) ){
    
                    if (self::$class_zip->open($name_folder) === TRUE) {
    
                        $del_zip = chop($name_folder , ".zip"); // لازالة .zip من اسم المجلد
                            if(self::$class_zip->extractTo($del_zip) === TRUE) {
    
                                echo "<div class='box' ><strong>تم فتح ضغط الملف بنجاح</strong>"; 
                                echo " <p class='nameFile'> " . $del_zip .  "</p> </div>" ;
    
                                for($i = 0; $i <= self::$class_zip->numFiles; $i++) {
    
                                    self::$class_zip->deleteIndex($i);  // لحذف الملفات بالمجلد
                                }
                                // لحذف المجلد يجب ان يكون فارغ
    
                            } 
                            
                        }else {
                            echo "لايوجد ملف مضغوط";
                        }
                }
            }
        }
        else{
            echo "<div class='box no_file'>لاتوجد ملفات مضغوطة </div>" ;
        }
    }


    function close_zip()
    {
        self::$class_zip->close();
    }
}



$openZip = new openZip(new ZipArchive());
$openZip->count_files();
// open with delete files
if(isset($_GET['open'])){
    $openZip->folderPath = $_GET['open'];
    $openZip->openZip();
}

// open without delete
if(isset($_GET['open_wathout_delete'])){
    $openZip->openZaipWathoutDelete();
}

// open user choose
if(isset($_GET['chos_file'])){

    $openZip->openZip_chos();
}


?>

