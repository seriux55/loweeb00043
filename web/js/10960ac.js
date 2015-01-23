$('a[href^="#"]').ready(function(){
    // au clic sur un lien
    
    // clic sur lechallenge
    $('a[href^="#ancre_offre"]').on('click', function(evt){
       // bloquer le comportement par dÈfaut: on ne rechargera pas la page
       evt.preventDefault(); 
       // enregistre la valeur de l'attribut  href dans la variable target
	var target = $(this).attr('href');
       /* le sÈlecteur $(html, body) permet de corriger un bug sur chrome 
       et safari (webkit) */
	$('html, body')
       // on arrÍte toutes les animations en cours 
       .stop()
       /* on fait maintenant l'animation vers le haut (scrollTop) vers 
        notre ancre target */
       .animate({scrollTop: $(target).offset().top}, 1000 ); 
    });
});