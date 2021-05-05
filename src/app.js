require ('bootstrap');


jQuery(document).ready(function(){
    $('body').set(function(){
        $('#first, #second').toggleClass('hidden');
    });
});