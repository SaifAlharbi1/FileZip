<?php

require_once "opan_file_zip.php";

class show_file extends openZip {

    function show_all_file(){

        if($this->countFile > 0){
            echo "<div class = 'all_name_file'>";
            foreach($this->get_file as $name){
                $name_new = substr($name,-15);
                echo "<div id='$name_new' class='$name_new box font_color' onclick='chose_file(this.id)'>". $name . "</div>";
        
            }
         echo "</div>";
        }else {
            echo "<div class='box no_file' >لاتوجد ملفات مضغوطة </div>" ;
        }
    }



    // function Test(){

    //     $zip = new ZipArchive();
    //     if ($zip->open("the-americans-fourth-season_arabic-1353811.zip") === TRUE) {
    
    //         $del_zip = chop("the-americans-fourth-season_arabic-1353811" , ".zip"); // لازالة .zip من اسم المجلد
    
    //             if($zip->extractTo("the-americans-fourth-season_arabic-1353811") === TRUE) {
    
    //                 echo "<div class='box' ><strong>تم فتح ضغط الملف بنجاح</strong>"; 
    
    //                 echo " <p class='nameFile'> " . $del_zip .  "</p> </div>" ;
    //     }else{
    //             echo "لم يتم الفتح";
    //     }
    // }else{
    //     echo "لايوجد المجلد";
    // }
    // }
}

if(isset($_GET['show'])){

    $show_file = new show_file(new ZipArchive());
    $show_file->folderPath = $_GET['show'];
    $show_file->count_files();
    $show_file->show_all_file();
    // $show_file->Test();
}

?>