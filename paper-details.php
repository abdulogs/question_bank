<?php require_once "./classes/app.php"; ?>
<!-- Middleware will redirect if session is out -->
<?php middleware::logout("id", "index"); ?>
<!-- Module -->
<?php f::module("papers/generated"); ?>
<!-- Url Param -->
<?php $action = http::param("action"); ?>
<!-- Paper info -->
<?php $data = module::single(); ?>
<!-- Categories array -->
<?php $categories = module::categories($data["categories"]); ?>
<!-- Questions array -->
<?php $questions = module::questions($data["questions"]); ?>
<!-- Settings -->
<?php $settings = module::settings(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $data["class"]." ".$data["subject"]; ?> paper</title>
    <link rel="shortcut icon" href="./src/images/logo.png" type="image/png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body style="font-size:14px;font-family:arial;margin:0;">

    <?php 
    $template = '<main>';
    $template .= '<section id="paper" style="display:flex;flex-direction:column;padding:20px;">';
    $template .= '<table style="font-size:14px;font-family:arial;width:100%; border:0; border-collapse: collapse;margin:0;" border="1"> ';
    $template .= '<tr>';
    $template .= '<td style="padding:20px;text-align:center;" colspan="8">';
    $template .= '<h2 style="font-size:30px;margin:5px 0;">'.$settings["name"].'</b></h2>';
    $template .= '<p style="font-size:18px;margin:0;">'.$settings["tagline"].'</p>';
    $template .= '</td>';
    $template .= '</tr>';
    $template .= '<tr>';
    $template .= '<td style="padding:5px;width:100px;"><b>Total Marks:</b></td>';
    $template .= '<td style="width:120px;padding:5px;">'.$data["total_marks"].'</td>';
    $template .= '<td style="padding:5px;width:100px;"><b>Total time:</b></td>';
    $template .= '<td style="width:120px;padding:5px;"><span>'.$data["total_time"].' mins </span></td>';
    $template .= '<td style="padding:5px;width:100px;"><b>Class:</b></td>';
    $template .= '<td style="width:120px;padding:5px;"><span>'.$data["class"].'</span></td>';
    $template .= '<td style="padding:5px;width:100px;"><b>Subject:</b></td>';
    $template .= '<td style="width:120px;padding:5px;"><span>'.$data["subject"].'</span></td>';
    $template .= '</tr>';    
    $template .= '</table>';    
    $template .= '</div>';    
    $template .= '<div style="background:white;padding:0 23px">';    
    $template .= '<ol style="padding:0px;">'; 
    
    // Looping questions with category id
    foreach($categories as $category) {
    $template .= '<li style="padding:10px 0;">';    
    $template .= '<b style="font-size:14px;">'.$category["statement"].'.</b>';    
    $template .= '<ol type="I" style="font-size:14px;font-family:arial;">';
    // Looping questions with chosen questions
        foreach($questions as $question) { 
        //  Check if this question belongs to the choose category
           if($question["category_id"] ==  $category["id"]){
                $template .= '<li style="padding:10px 0;">';    
                $template .= '<div style="margin:0;">';    
                $template .= '<b>'.$question["statement"].'</b>';    
                $template .= '<span style="font-size:12px;">&nbsp; &nbsp; &nbsp;';    
                if(!empty($question["marks"])){
                    $template .= $question["marks"].' '.f::is_plural($question["marks"],"Mark").", ";    
                }  if(!empty($question["estimated_time"])){
                    $template .= $question["estimated_time"].' '.f::is_plural($question["estimated_time"],"Min");    
                }
                $template .= '</span>';
                $template .= '</div>';
                if($question["image"]){
                    $template .= '<p style="margin:0px;padding:10px;"><img src="'.$question["image"].'" width="350"></p>';
                }
                if($question["is_options"] == 1){  
                    $template .= '<ol style="display:flex;flex-wrap:wrap;margin-top:10px;" type="a">';
                    $template .= '<li style="width:50%;">'.$question["opt1"].'</li>';    
                    $template .= '<li style="width:50%;">'.$question["opt2"].'</li>';    
                    $template .= '<li style="width:50%;">'.$question["opt3"].'</li>';    
                    $template .= '<li style="width:50%;">'.$question["opt4"].'</li>';    
                    $template .= '</ol>';   
                }
                $template .= '</li>';
            }
        }
    $template .= '</ol>'; 
    $template .= '</li>'; 
    }
    $template .= '</div>';
    $template .= '</section>';
    $template .= '</main>';

    echo $template;
    ?>  
    
    <?php if($action == "pdf"): ?>
    <script>
    const options = {
            margin: 0,
            filename: "<?php echo $data["class"]."-".$data["subject"]; ?>-paper.pdf",
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            pagebreak: {mode: 'avoid-all'},
            jsPDF: { unit: 'pt', format: 'a4', orientation: 'p' }
        }
        html2pdf().set(options).from(document.getElementById('paper')).save();
    </script>
    <?php endif; ?>    


    <?php if($action == "doc"): ?>
    <script>
        function Export2Doc(element, filename = ''){
            var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
            var postHtml = "</body></html>";
            var html = preHtml+document.getElementById(element).innerHTML+postHtml;

            var blob = new Blob(['\ufeff', html],{
                type: 'application/msword'
            });

            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html)

            filename = filename?filename+'.doc': 'document.doc';

            var downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if(navigator.msSaveOrOpenBlob){
                navigator.msSaveOrOpenBlob(blob, filename);
            }else{
                downloadLink.href = url;

                downloadLink.download = filename;

                downloadLink.click();
            }
            document.body.removeChild(downloadLink);
        }
        Export2Doc('paper', '<?php echo $data["class"]."-".$data["subject"]; ?>-paper');
    </script>
    <?php endif; ?>

    <?php if($action == "print"): ?>
    <script>
        const header = "<html><head><title><?php echo $data["class"]."-".$data["subject"]; ?>-paper</title></head><body>";
        const footer = "</body>";
        const body = document.getElementById("paper").innerHTML;
        const old_body = document.body.innerHTML;
        document.body.innerHTML = header + body +footer;
        window.print();
        document.body.innerHTML = old_body;
    </script>
    <?php endif; ?>
</body>

</html>