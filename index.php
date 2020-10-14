<?php

$post_max_size = (int)number_format(ini_get('post_max_size'));
$maxFileSize = $post_max_size * 1000 * 1024;

?>

<html>
<head>
    <link href="/files/css/uploadfile.css" rel="stylesheet">
    <link href="/files/css/uploadfile.custom.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/files/js/jquery.uploadfile.js"></script>
</head>
<body>

<p style="padding: 10px;">
    ※ 용량 제한 : <?php echo ini_get('post_max_size'); ?> <br>
    - <?php echo ini_get('post_max_size'); ?> 이상의 대용량 파일은 관리자에게 별도로 말씀해주세요<br>
    - 등록/삭제 내역은 시스템에 기록됩니다.
</p>

<div id="fileuploader">Upload</div>

<script>
    $(document).ready(function() {

        $("#fileuploader").uploadFile({
            url:"/files/upload.php",
            multiple:false,
            dragDrop: true,
            fileName: "myfile",
            returnType: "json",
            showDelete: true,
            showDownload:true,
            showLink:true,
            showVideo:true,
            statusBarWidth:800,
            dragdropWidth:800,
            maxFileSize:<?php echo $maxFileSize; ?>,
            //showPreview:true,
            previewHeight: "100px",
            previewWidth: "100px",
            onLoad:function(obj)
            {
                $.ajax({
                    cache: false,
                    url: "/files/load.php",
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],'<?php echo $_SERVER['HTTP_HOST']; ?>');
                        }
                    }
                });
            },
            deleteCallback: function (data, pd) {
                for (var i = 0; i < data.length; i++) {
                    var conf = "삭제하시겠습니까? \r\n삭제시 복구 불가능합니다.";
                    if (confirm(conf)) {
                        $.post("/plugin/jquery.uploadfile/delete.php", {op: "delete",name: data[i]},
                            function (resp,textStatus, jqXHR) {
                                alert("삭제되었습니다.");
                            });
                    }
                }
                pd.statusbar.hide(); //You choice.

            },
            downloadCallback:function(filename,pd)
            {
                location.href="/files/download.php?filename="+filename;
            }
        });
    });
</script>
</body>
</html>