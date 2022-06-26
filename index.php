// test uplo
<style>
    body {
        direction: rtl;
        background-color: #e3e7eab0;
    }
    .all_page {
        display: flex;
    }
    .all_click {
        width: 45%;
        text-align: center;
        padding-top: 17px;
    }
    .all_click input {
        width: 100%;
        height: 40px;
        border-radius: 5px;
        border: 1px solid green;
        padding-left: 5px;
        color:  #1b6f7b;;
        font-weight: 600;
        text-align: left;
        outline: none;
        margin-bottom: 60px;
        text-align: center;
    }
    label {
        display: block;
        padding: 8px
    }
    .all_click input:focus {
        outline: 1px solid green;
    }
    .click_send {
        width: 55%;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid green;
        margin-top: 50px;
        border-radius: 4px;
        cursor: pointer;
        background-color: white;
        transition: .5s;
        margin: 13px auto 0;
    }
    .click_send:hover {
        background: #0080000d;
    }
    #name_file_and_cho {
        position: relative;
        width: 90%;
        display: flex;
        flex-direction: column;
    }
    .loding {
        position: absolute;
        height: 100%;
        width: 100%;
        display: none;
    }
    .loding img {
        opacity: .5;
        width: 100%;
        height: 100%;
    }


    .all_name_file {
        text-align: left;
        padding: 14px;
        color: mediumblue;
        font-weight: bold;
    }
    .all_name_file div {
        background-color: white;
        padding: 11px;
        border-radius: 4px;
        margin-top: 1px;
        cursor: pointer;
    }
    .box {
        box-shadow: 2px 2px 2px #047f194d;
        background: white;
        color:green;
        border-radius: 9px;
        text-align: center;
        width: 75%;
        margin: 6px auto;
        padding: 20px 20px;
        font-weight: bold;
    }
    .nameFile {
        background-color: #0000000a;
        color: blue;
        border-radius: 4px;
        padding: 7px;
        margin-top: 10px;
        margin-bottom: 0;
    }
    .no_file {
        width: 50%;
        margin: 59px auto;
        color:red
    }
    .font_color {
        color: blue;
    }
    .Active {
        background-color: #a9ceb366  !important;
    }

    #chose_fi{
        display: none;
    }
</style>


<div class="all_page" id="all_page">
    <div class="all_click">
            <label for="path">مسار الملفات المضغوطة</label>
            <input type="text" name="" id="path" value="C:/Users/saifa/Downloads/">
            <!-- <input type="file" name="" id="user_chos" > -->
            <div id="show" class="click_send" onclick="ajax_opan_zip(this.id)">اظهار الملفات المضغوطة</div>
            <div id="send" class="click_send" onclick="ajax_opan_zip(this.id)">فتح الملفات المضغوطة</div>
            <div id="" class="click_send" onclick="wathout_opan_zip()">فتح الملفات المضغوطة بدون حذف الملفات</div>
    </div>
    <div id="name_file_and_cho">
        <div class="loding"><img src="loding.gif" alt="" srcset=""></div>
        <div id="name_file_opan">

        </div>
        <div id="chose_fi" class="click_send" onclick="open_chose_zip()">فتح الملفات المختارة</div>
    </div>
</div>



<script>

// with delete file 
function ajax_opan_zip(id){

    let url = [];
    if(id === "send"){
         url = "opan_file_zip.php?open=";
    }
    else if(id === "show"){
         url = "show_name_file.php?show=";
    }
   
    const xhttp = new XMLHttpRequest();
    const input_value = document.getElementById('path').value;
    // let user_chos = document.getElementById('user_chos').value;
    let name_zip = input_value + "*.zip";
    let loding = document.querySelector('.loding');
    // console.log(input_value);
    xhttp.onreadystatechange = function() {

        if(this.readyState == 1 ){
        loding.style.display = "block";
       
        }
        if(this.readyState == 4){
            loding.style.display = "none";
            document.getElementById("name_file_opan").innerHTML = this.responseText
        }
        //   console.log(this.responseText);
    }
    console.log(name_zip);
    xhttp.open("GET", url + name_zip );
    xhttp.send();
 
}


// jast delete 

function wathout_opan_zip(){

    let url = "opan_file_zip.php?open_wathout_delete=";

    const xhttp = new XMLHttpRequest();
    const input_value = document.getElementById('path').value;
    let name_zip = input_value + "*.zip";

    let loding = document.querySelector('.loding');
    // console.log(input_value);
    xhttp.onreadystatechange = function() {

    if(this.readyState == 1 ){
        loding.style.display = "block";
        console.log(1234);
    }
    if(this.readyState == 4){
        loding.style.display = "none";
        document.getElementById("name_file_opan").innerHTML = this.responseText
    }
    //   console.log(this.responseText);
    }
    xhttp.open("GET", url + name_zip );
    xhttp.send();

}


// لاختيار الملف 

let file = [];
function chose_file(id){

  let get_file =  document.getElementById(id);
  if(file.includes(get_file.textContent)){
      let get_index = file.indexOf(get_file.textContent);
      file.splice(get_index,1);
  }else{
        file.push(get_file.textContent);
  }
 
  get_file.classList.toggle("Active"); // لاختيار الملف والغاء الاختيار

  let botton = document.getElementById("chose_fi");
  if(file.length > 0){
        botton.style.display ="flex";
  }else{
        botton.style.display ="none";
  }
  
}

function open_chose_zip(){

    let url = "opan_file_zip.php?chos_file=";
    const xhttp = new XMLHttpRequest();
    let user_chos = file;
    let loding = document.querySelector('.loding');
    // let name_zip = input_value + "*.zip";

    xhttp.onreadystatechange = function() {

        if(this.readyState == 1 ){
        loding.style.display = "block";
        }
        if(this.readyState == 4){
            loding.style.display = "none";
            document.getElementById("name_file_opan").innerHTML = this.responseText
        }

        // Fetch all files and delete opened files 
        let get_all_active = document.querySelectorAll(".Active");
                for (let i = 0; i< get_all_active.length; i++) {     
                    get_all_active[i].style.display = "none";
                    user_chos.forEach(e =>{
                            if( e == get_all_active[i].textContent){
                                let get_index = user_chos.indexOf(e);
                                user_chos.splice(get_index,1);
                                console.log(get_all_active)
                            }  
                        })
                        get_all_active[i].textContent = " "; // مسح اسم الملف   
                }
        
    }


   
    
    xhttp.open("GET", url + user_chos );
    xhttp.send();
}
</script>
