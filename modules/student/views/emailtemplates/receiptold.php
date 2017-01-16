<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
if($_GET['invoiceTemplate']){
    $this->title = $payment->student->name .' Enrollment Receipt for '. $payment->enrollmentType->title;
    $this->params['breadcrumbs'][] = ['label' => 'Payment receipt', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;

}

$formatter = \Yii::$app->formatter;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php print Yii::$app->params->recceiptEmailSubject; ?></title>
    
    <style>
    .invoice-box{
        max-width:1080px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:145px;
        color:#333;
        position:relative;margin-top:0px;
        background:url(<?php print Yii::$app->params['company']['logo']; ?>) top center no-repeat;
        width:500px;
        height: 150px;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:4px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    @media print {
    .invoice-box {page-break-after: always;}
    }
    </style>
     <script>
      function printContent(el)
      {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         
         document.body.innerHTML = restorepage;
     }window.print();
   </script>
</head>

<body>
    <div class="invoice-box" style=" max-width:1080px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;">
        
        <?php if($_GET['printView']){
                    print Html::a('Back', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
                  <?php  //print Html::a('Pay Now', ['/payment/load', 'invoiceid' => $invoice->id], ['class' => 'btn btn-primary']); 
            }
            ?>
        <table cellpadding="0" cellspacing="0" style="width:100%;
        line-height:inherit;
        text-align:left;">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr  >
                            <td colspan="2" style="font-size:45px; " >
                                <img src="<?php print Yii::$app->params['company']['logo'];?>" style="font-size:45px; width: 100%;max-width:1080px"></td>
                               </td>
                        </tr>    
                        <tr  >
                            <td  style="font-size:45px;" >
                                
                                
                            </td>
                            
                            <td>
                                Student Id: <?= $model->refrence_number; ?><br>
                                Created: <?= $formatter->asDate($model->create_date, 'long');?><br>
                                <!--Due: February 1, 2015-->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
    
            <tr class="information">
                <td colspan="2">
                    <table>
<!--                        <tr>
                            <td style=" display:block; text-align:left;"><strong>To:</strong></td>
                            <td style="text-align:left; padding-left:40px;">
                                <strong>From:</strong></td>
                        </tr>-->
                        <tr>
                            <td>
                 <?php echo      DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'refrence_number',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'date_of_birth',
            'nationality',
            'address:ntext',
            'phone',
            'mobile',
            'email:email',
            'class_nine_school',
            'class_nine_city',
            'class_nine_country',
            'class_ten_school',
            'class_ten_city',
            'class_ten_country',
            'class_eleven_school',
            'class_eleven_city',
            'class_eleven_country',
            'suspended_from_school',
            'suspended_details:ntext',
            'languages_spoken:ntext',
            'support_admission_decsion:ntext',
            'emergency_name',
            'emergency_relation',
            'emergency_contact',
            'emergency_address:ntext',
            'emergency_email:email',
            'primary_contact',
            'speaking_event:ntext',
            'drama_theater:ntext',
            'sports_continue',
            'subject_selected:ntext',
            'course_after_alevel',
            'why_bvc:ntext',
            'contribute_bvc:ntext',
            'tenyears_fromnow:ntext',
            'strength_weaknesses:ntext',
            'exampe_leadership:ntext',
            'essay_topic',
            'essay_content:ntext',
            ['attribute' => 'photo_path',
             'label'=>'Photograph', 
             'format'=>'raw',    
             'value' => ($model->photo_path !='') && file_exists("uploads/thumbs/".$model->photo_path)?
                        Html::img(Url::to(['/'], true)."uploads/thumbs/".$model->photo_path)
                : "Image not Available "."@web/uploads/thumbs/".$model->photo_path
            ] ,
//            'photo_path',
//            'admin_path:ntext',
            
//            'updated',
            'create_date',
        ],
                     ]);?> 
                            </td>
                        </tr>            
                    </table>
                </td>
            </tr>
        </table>    
    </div>
    
</body>
</html>
