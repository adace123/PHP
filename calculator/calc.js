$(document).ready(() => {
    $('.calculator').draggable();
    let neg = false;

    $('.numbers').click((e) => {             
      neg = true;
      insertNumber(e.target.innerHTML);       
    });

    $('.operator').click((e) => {
            if($(e.target).is('button'))
            $('#results').text($('#results').text() + " " + e.target.innerHTML + " ");
            else $('#results').text($('#results').text() + " " + "/" + " ");    
    });

    $('#sign').click(() => { 
      if(neg && !isNaN(calcEntry(1))){
        if(calcLength()===1){
            $('#results').text("-" + $('#results').text());
        } else{ 
            $('#results').text($('#results').text().substring(0,$('#results').text().lastIndexOf(" ")) + " -" + $('#results').text().substring($('#results').text().lastIndexOf(" ")+1));
        }
    } else if(!neg && !isNaN(calcEntry(1))){
        $('#results').text($('#results').text().substring(0,$('#results').text().lastIndexOf("-")) + " " + $('#results').text().substring($('#results').text().lastIndexOf("-")+1));
    } 
    neg = !neg;
    });

    $('#backspace').click(() => {   
        $('#results').text($('#results').text().substring(0,calcLength()-1));
        if(calcLength() === 0){
            $('#results').text(0);
        }
    });
    
    $('#equals').click((e)=>{
           if(isNaN(calcEntry(1))){
                   $('#results').text('Error');
               } else{
                    $('#calculateResults').val($('#results').text());
                    $.post('http://localhost/calculator/results.php',$('form').serialize(),(data) => {
                       $('#results').text(data); 
                    });          
               }  
    });
    
    $('#clear').click(() => {
      $('#results').text(0);
    });
   
   let insertNumber = (text) => {
     let currentText = $('#results').text();
       if(currentText === '0'){
         $('#results').text(text);
       } else {
         $('#results').text(currentText + '' + text);
       }
    };

    let calcEntry = (num) => {
        return $('#results').text().trim().split("")[$('#results').text().length-num];
    };

    let calcLength = () => {
        return $('#results').text().length;
    };
  
  });
  
