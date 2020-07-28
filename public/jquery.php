<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>ajax</h1>
<!--<script>-->
<!--    var url  = '/jquery2.php';-->
<!--var xhr = new XMLHttpRequest();-->
<!--xhr.open('GET','/jquery2.php',true)-->
<!--    xhr.send()-->
<!---->
<!--    xhr.onreadystatechange = function(){-->
<!--    if(xhr.readyState === xhr.DONE){-->
<!--        if(xhr.status === 200){-->
<!---->
<!--            var content = xhr.responseText-->
<!--            console.log(xhr.responseText)-->
<!--        }else{-->
<!--            alert('There was a problem with the erquest.');-->
<!--        }-->
<!--    }-->
<!--    }-->
<!--</script><!--ajax原生代码--!>-->

<script src="/js/jquery.js"></script>
<script>
    document.cookie = "name=zhangsan"       //存cookie
    document.cookie = "age= 999"        //存cookie

    var uid = 888999;
    $.ajax({
        url:"http://www.1911.com/jquery2.php",
        type : "GET",
        headers:{'uid':uid},                //头部存值

        dataType : "jsonp",
        success: function(data){
            console.log(data)
        }

    })

</script>
</body>
</html>