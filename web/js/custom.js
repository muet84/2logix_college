/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$( document ).ready(function() {

$('.field-student-suspended_details').hide();

$('#student-suspended_from_school input[type="radio"]').click(function(){
    if($(this).val() == 'yes') $('.field-student-suspended_details').show();
    else $('.field-student-suspended_details').hide(); console.log($(this).val() );
});

/*
 *  Subject Selected
 */
var element = $('#Chemistry'); var disableElem = $('#Accounts')
disableAssosiate(element, disableElem );

var element = $('#Accounts'); var disableElem = $('#Chemistry')
disableAssosiate(element, disableElem );

var element = $('#Biology'); var disableElem = $('#Economics')
disableAssosiate(element, disableElem );

var element = $('#Economics'); var disableElem = $('#Biology')
disableAssosiate(element, disableElem );

var element = $('#Psychology'); var disableElem = $('#Law')
disableAssosiate(element, disableElem );

var element = $('#Law'); var disableElem = $('#Psychology')
disableAssosiate(element, disableElem );

var element = $('#History'); var disableElem = $('#Urdu')
disableAssosiate(element, disableElem );

var element = $('#Urdu'); var disableElem = $('#History')
disableAssosiate(element, disableElem );


function disableAssosiate(element, disableElem ){
    element.click(function(){
    if($(this).is(':checked') ){  
        $(this).parents('td').attr('class', 'bg-success');
        disableElem.attr("disabled", true);}
    else {disableElem.removeAttr('disabled');
        $(this).parents('td').attr('class', 'gray_class');
        }
    
   
    console.log($(this).is(':checked') )
    })
}
$("input[name='Student[subject_selected][]']").click(function (){
    if($(this).is(':checked') ){  
            $(this).parents('td').attr('class', 'bg-success');
    }else {
            var newClass= "gray_class";
                if($(this).parents('td').next('td').attr('class') == 'gray_class'
                        || $(this).parents('td').previous('td').attr('class')) 
                    newClass = "";
                $(this).parents('td').attr('class', newClass);
            }
    
})

$('.field-student-subject_selected').mouseleave(function(){
var subjectSelected = $("input[name='Student[subject_selected][]']:checked").length ;
if( subjectSelected > 5 || subjectSelected < 2) {
//console.log('select 2 to 5'+""+subjectSelected);
$(this).find('.help-block').addClass('alert alert-danger').show()
        .html("Please Select minimum 2 maximum 5 Subjects, current selected:"+ subjectSelected);
        $('button[name="student-btn"]').attr('disabled', 'disabled');
}else {
    $(this).find('.help-block').hide();
    $('button[name="student-btn"]').removeAttr('disabled')
    }
})
/*
 * subject Selected End
 */
//$('#student-verifycode, #student-imagefiles').on('change', function(){
//   
//    setTimeout(function(){
//        if($('#student-imagefiles').val() == "") {
//         
//         $('#student-imagefiles').parent('div').addClass('has-error')
//                $('#student-imagefiles').parent('div').find('.help-block')
//            .html("You Forogt to upload passport photograph.").show();
//         $('button[name="student-btn"]').attr('disabled', 'disabled');
//         
//        } else
//        $('button[name="student-btn"]').removeAttr('disabled');
////        
//    } , 1000)  
//     
//    });

subjectsArray= [];
lastSubjectSelected =null ; 
lastDDID = null;
    
    $('body').on('click','.subject-dd', function() {
        var thisDD =$(this);
         var thisID = thisDD.attr('id');
        if(subjectsArray.length > 0){
            $.each(subjectsArray, function(i, v){
                if(v != thisDD.val())
             $('#'+thisID+'  option[value*="'+v+'"]').prop('disabled', true);
            })
        }
//        setTimeout( checkAcademic(thisDD), 1500);
    });
    $('body').on('change','.subject-dd', function() {
        var thisDD =$(this);
        setTimeout( checkAcademic(thisDD), 1500);
    })
});  //document ready      
function checkAcademic(thisDD){
            if($.inArray(thisDD.val(), subjectsArray) == -1 ){
                subjectsArray.push(thisDD.val());
                var thisID = thisDD.attr('id');
                
                if(lastSubjectSelected != thisDD.val() && thisID == lastDDID){
                    subjectsArray.splice($.inArray(lastSubjectSelected, subjectsArray),1);
                }
                lastSubjectSelected = thisDD.val();                
                lastDDID = thisID;

//                $('#'+thisID+' option:not(:selected)').prop('disabled', true);
//            thisDD.('option:not(:selected)').prop('disabled', true);
            }
//            else {console.log(1);var ddelem = thisDD; 
//                        displayError(ddelem, '"Subject already added."')
//            }
//                console.log(thisDD.val() );
                
            }
function displayError(elemToError, message){
                console.log(2)
    elemToError.parent('div').addClass('has-error');
    elemToError.parent('div').find('.help-block')
            .html(message).show();
    elemToError.val('');
            }
