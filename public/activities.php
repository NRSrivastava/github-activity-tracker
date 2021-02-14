<?php
session_start();
if((!isset($_SESSION['user']))||(!isset($_SESSION['userData']))){
    session_destroy();
    Die("Not Logged In!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
    <style>
        body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
            'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue',
            sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        }

        code {
        font-family: source-code-pro, Menlo, Monaco, Consolas, 'Courier New',
            monospace;
        }
        a{
            text-decoration: none;
        }
        h4{
            margin:0;
            padding:0;
            color:white;
        }
        .collapsible {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        border-radius:20px;
        }
        .collapsible:after{
            content:'\002B';
            float:right;
            margin-left: 5px;
        }
        .active:after {
        content: "\2212";
        }

        .active, .collapsible:hover {
        background-color: #ccc;
        }

        /* Style the collapsible content. Note: hidden by default */
        .content {
        padding: 0 18px;
        background-color: white;
        color: black !important;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        border-radius:20px;
        }
        th{
            text-align: center;
            padding: 5px 0px 5px 0px;
            word-break: break-all;
        }
        td{
            text-align: center;
            padding: 5px 0px 5px 0px;
            word-break: break-all;
        }
        #loadButton{
            color:white;
            box-sizing: border-box;
            width:100%;
            background-color: transparent;
            border: 1px solid white;
            margin: 10px 0px 10px 0px;
            padding: 5px;
            border-radius: 10px;
            height: 2rem;
        }#loadButton:hover{
        background-color:#444444;
        cursor:pointer;
        }
    </style>
</head>
<body style="background-color:#231f20">
    <div id="viewSection">
      <!--   <h4>Create Event / 5151045801</h4>
        <button type="button" class="collapsible">NRSrivastava/ReactAppUsingWebpackWebDevAndBabel 46863299 <a href="https://w3schools.com">&#128279;</a></button>
        <div class="content" style="color: white; width: 100%;box-sizing: border-box;">
            <div style="width:10%;float: left;background-color:tan;display: flex; flex-direction: column; align-items: center;">
                <img src="https://avatars.githubusercontent.com/u/46863299" alt="" style="width:100%;max-width:50px;padding: 10px;border-radius: 20px;">
                
                <span style="width:100%;padding:10px;margin:0px 0px 10px 0px; font-size: 1em; word-wrap: break-word;text-align: center;">NRSrivastava</span>
            </div>
            <div style="float: left;width: 90%;">
                <table style="max-width: 923px; width:100%">
                    <tr style="width: 100%; text-align: center;">
                        <td colspan="6">2021-02-11T14:15:14Z</td>
                    </tr>
                    <tr>
                        <th>Ref</th>
                        <th>Ref Type</th>
                        <th>Master Branch</th>
                        <th>Description</th>
                        <th>Pusher Type</th>
                        <th>Public</th>
                    </tr>
                    <tr>
                        <td>master</td>
                        <td>branch</td>
                        <td>master</td>
                        <td>null</td>
                        <td>user</td>
                        <td>true</td>
                    </tr>
                </table>
            </div>
        </div>  -->
    </div>
        <button id='loadButton'><span style="position:absolute;visibility: visible;">Load More</span><img src="bars.gif" width=70px height=100% style="visibility:hidden;"/></button>
<script>
    let page=1;
    let elem=document.getElementById('viewSection');
    function getElement(js){
    const element='<h4>'+js.type+' / '+js.id+'</h4>\
        <button type="button" class="collapsible">'+js.repo.name+' '+js.repo.id+'<a href="'+js.repo.url+'">&#128279;</a></button>\
        <div class="content" style="color: white; width: 100%;box-sizing: border-box;">\
            <div style="width:10%;float: left;background-color:tan;display: flex; flex-direction: column; align-items: center;">\
                <img src="'+js.actor.avatar_url+'" alt="" style="width:100%;max-width:50px;padding: 10px;border-radius: 20px;">\
                <span style="width:100%;padding:10px;margin:0px 0px 10px 0px; font-size: 1em; word-wrap: break-word;text-align: center;">'+js.actor.display_login+'</span>\
            </div>\
            <div style="float: left;width: 90%;">\
                <table style="max-width: 923px; width:100%">\
                    <tr style="width: 100%; text-align: center;">\
                        <td colspan="6">'+js.created_at+'</td>\
                    </tr>\
                    <tr>\
                        <th>Ref</th>\
                        <th>Ref Type</th>\
                        <th>Master Branch</th>\
                        <th>Description</th>\
                        <th>Pusher Type</th>\
                        <th>Public</th>\
                    </tr>\
                    <tr>\
                        <td>'+js.payload.ref+'</td>\
                        <td>'+js.payload.ref_type+'</td>\
                        <td>'+js.payload.master_branch+'</td>\
                        <td>'+js.payload.description+'</td>\
                        <td>'+js.payload.pusher_type+'</td>\
                        <td>'+js.public+'</td>\
                    </tr>\
                </table>\
            </div>\
        </div><br>';
    return element;
    }
    
    function update(){
        let coll = document.getElementsByClassName("collapsible");
        for (let i=0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
            content.style.maxHeight = null;
            } else {
            content.style.maxHeight = content.scrollHeight + "px";
            }
        });
        }
    }
    let lb=document.getElementById('loadButton');
    const get_the_Data= ()=>{
        lb.getElementsByTagName('span')[0].style.visibility='hidden';
        lb.getElementsByTagName('img')[0].style.visibility='visible';
      const url = "backActivity.php?page=";
      fetch(new Request(url+(page++).toString())).then((response)=>{
            response.json().then((data)=>{
                if(data.length==0){
                    lb.getElementsByTagName('span')[0].innerHTML="No More!";
                }
                data.forEach(element => {
                    elem.innerHTML+=getElement(element);
                });
                update();
                lb.getElementsByTagName('span')[0].style.visibility='visible';
                lb.getElementsByTagName('img')[0].style.visibility='hidden';
            });
         }); 
    }
    lb.addEventListener('click',get_the_Data);
    get_the_Data();
</script>
</body>
</html>