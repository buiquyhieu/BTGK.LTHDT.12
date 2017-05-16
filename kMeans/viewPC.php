<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <style>
            div{
                position: absolute;
                width: 10px;
                height: 10px;
                /*background-color: green;*/
            }
           
        </style>
    </head>
    <body style="position: relative">
        <script>
            var mang = new Array();
            
                $.ajax({
                    url: 'kmean.php',
                    type: 'post',
                    dataType: 'json',
                    success: function (result) {
                        console.log(result);

                        
                        $.each(result, function (key, item) {
                            mang.push(item);
                        });
                        
                        for (var i = 0; i < mang.length; i++) {
                            for (var j = 0; j < mang[i]['tamcum'].nhom; j++) {
                                var div = document.createElement("div");
                                var xleft=mang[i][j].van * 100;
                                var ytop=mang[i][j].toan * 100;
                                var mau=mang[i][j].nhom * 50;
                                div.style.top = ytop + "px";
                                div.style.left = xleft + "px";
                                div.style.backgroundColor = "rgb(90,"+parseFloat(mau*i*2+50)+"," + mau + ")";
                                document.body.appendChild(div);
                            }
                            var div = document.createElement("div");
                                div.style.top = mang[i]['tamcum'].toan * 100 + "px";
                                div.style.left = mang[i]['tamcum'].van * 100 + "px";
                                div.style.backgroundColor = "rgb(255,0,0)";
                                div.style.color="rgb(255,0,0)";
                                var node=document.createTextNode("Cụm"+parseInt(i+1)+" ("+Math.round(mang[i]['tamcum'].toan * 100)+","+Math.round(mang[i]['tamcum'].van * 100)+")");
                                div.appendChild(node);
                                document.body.appendChild(div);
                        }
                    }
                });
            
        </script>

        <?php
       
        ?>
    </body>
</html>
