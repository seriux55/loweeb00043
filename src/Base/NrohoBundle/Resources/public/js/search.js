$(document).ready(function(){

	$("select#departsearch").change(function(){
		document.getElementById("loadersearch").style.display='block';
		var idVal = $("select#departsearch option:selected").attr('value');
		$("select#arriversearch").attr("disabled", true);	
		$.getJSON("controllers/search.php",{depart: idVal, ajax: "true"}, function(json){				
			var options = "";
			if (json != null){					
				for (var i = 0; i < json.length; i++){
					options += '<option value="' + json[i].wilaya + '">' + json[i].wilaya + '</option>';
				}					
			}
			if (options != ""){ $("select#arriversearch").html(options).attr("disabled", false); }				
			document.getElementById("loadersearch").style.display='none';
		});
	});	
	
	$("#search").click(function(){
		var idVal1 = $("select#departsearch  option:selected").attr('value');
		var idVal2 = $("select#arriversearch option:selected").attr('value');
		if(idVal1!=='' || idVal2!=null){ 
			Years = new Date; year = Years.getFullYear();
			document.getElementById("loadersearching").style.display='block';
			$.getJSON("controllers/filtre.php",{depart: idVal1, arriver: idVal2, ajax: "true"}, function(jsonn){
				var annonce = '';
				if (jsonn != null){
					for (var i = 0; i < jsonn.length; i++){						
						annee = ''; anne ='';
						if(jsonn[i].naissance!="") annee = year - jsonn[i].naissance; else annee ="";
						if(jsonn[i].naissance!="") anne  = annee + ' ans'; 			  else anne  ="";
						annonce +='			<div class="sectionn">';
						annonce +='					<div class="caseoi">';
						annonce +='						<a href="detail_produit.php?anne=' + jsonn[i].idPaki + '">';
						annonce +='					<div class="choirc1">';
						annonce +='						<div class="detrc">';
						annonce +='							<div class="nouvie3">';	
																if(jsonn[i].sexe == "Mlle") annonce +='<img src="../images/femme_1.jpg" alt="covoiturage Rose"/>';
																if(jsonn[i].sexe == "Mr")   annonce +='<img src="../images/homme_1.jpg" alt="covoiturage Moustache"/>';
						annonce +='							</div>';
						annonce +='							<p class="prixnuit">';
																if(jsonn[i].sexe == "Mlle") if(jsonn[i].type == "1") annonce +='Conductrice'; else annonce +='Passagère';
																if(jsonn[i].sexe == "Mr")   if(jsonn[i].type == "1") annonce +='Conducteur';  else annonce +='Passager';		
						annonce +='								<br/><strong>' + jsonn[i].nom + '</strong>';
						annonce +='							</p>';
						annonce +='						</div>';
						annonce +='						<div class="destrcco">';
						annonce +='							<div class="detrc">';
						annonce +='								<p>' + anne +'</p>';
						annonce +='							</div>';
						annonce +='							<div class="detrc">';	
						annonce +='							</div>';
						annonce +='							<div class="detrc">';
						annonce +='								<p>' + jsonn[i].vehicule + '</p>';
						annonce +='							</div>';
						annonce +='						</div>';
						annonce +='						<div class="opicon">';
															if(jsonn[i].type != '1') annonce += ""; else { 	
																if (jsonn[i].fumer   == 'non') annonce +='<div class="nouvie2"><img src="../images/cigarette.png" alt="covoiturage non fumeur"/></div>';
																	else annonce +='<div class="nouvie2"><img src="../images/accepte_fumeur.png" alt="covoiturage fumeur"/></div>';
																if (jsonn[i].musique == 'non') annonce +='<div class="nouvie2"><img src="../images/musique.png" alt="covoiturage pas de musique"/></div>';
																	else annonce +='<div class="nouvie2"><img src="../images/accepte_musique.png" alt="covoiturage musique"/></div>';
																if (jsonn[i].animal  == 'non') annonce +='<div class="nouvie2"><img src="../images/mouton.png" alt="covoiturage sans animaux"/></div>';
																	else annonce +='<div class="nouvie2"><img src="../images/accepte_animaux.png" alt="covoiturage avec animaux"/></div>';
																if (jsonn[i].blabla  == 'non') annonce +='';
																	else annonce +='<div class="nouvie2"><img src="../images/gosra.png" alt="covoiturage en gosra"/></div>'; 
															}
						annonce +='						</div>';
						annonce +='					</div>';
						annonce +='					</a>';
						annonce +='					<div class="rc">';
						annonce +='						<a href="detail_produit.php?anne=' + jsonn[i].idPaki + '">';
						annonce +='						<div class="nouveau1">';
						annonce +='							<div class="nouvie1">';
						annonce +='								<p>'+ jsonn[i].depart.substring(5); if(jsonn[i].villea != "") annonce +=' (' + jsonn[i].villea + ') '; annonce +='</p>';
						annonce +='							</div>';
						annonce +='							<div class="nouvie2">';
						annonce +='								<img src="../images/fleche_2.png" alt="vers"/>';
						annonce +='							</div>';
						annonce +='							<div class="nouvie1">';
						annonce +='								<p>';
																	if(jsonn[i].arriver!="") { annonce += jsonn[i].arriver.substring(5); if(jsonn[i].villeb != "") annonce +=' (' + jsonn[i].villeb + ') '; }else{
																	if(jsonn[i].emplacement!="" && jsonn[i].challenge==""){ annonce += jsonn[i].emplacement + ' - ' + jsonn[i].wilaya.substring(5); }
																	}
						annonce +='								</p>';
						annonce +='					   		</div>';
						annonce +='						</div></a>';
															if(jsonn[i].arriver=="" && jsonn[i].titre!="" && jsonn[i].challenge==""){ annonce += '<div class="lavir"><p>Destination : ' + jsonn[i].titre + '</p></div>'; }
															if(jsonn[i].challenge!=""){ annonce += '<div class="lavir"><p>Destination : ' + jsonn[i].challenge + ' - nroho challenge</p></div>'; }
						annonce +='						<div class="nouveau2">';
						annonce +='							<article>';
						annonce +='							<a href="detail_produit.php?anne=' + jsonn[i].idPaki + '"><h1>Le ' + jsonn[i].date; if(jsonn[i].heure != ""){ annonce += ' - ' + jsonn[i].heure; } annonce += '</h1></a>';
						annonce +='							<p>' + jsonn[i].message +'</p>';
						annonce +='							</article>';
						annonce +='						</div>';
						annonce +='					</div>';
						annonce +='					<div class="choirc">';
						annonce +='						<div class="detrc">';
						annonce +='							<p class="prixnuito">';
						annonce +='								<strong>' + jsonn[i].prix + '</strong> Dinars';
						annonce +='							</p>';
						annonce +='						</div>';
						annonce +='						<div class="detrc1">';
						annonce +='							<p><strong>' + jsonn[i].place + '</strong> places<br/>';
																if(jsonn[i].type=="1") annonce +='libres'; 
						annonce +='							</p>';
						annonce +='						</div>';
														if (jsonn[i].filles == "1") annonce +='<div class="detrc1p"><p>Entre Elles</p></div>';
						annonce +='					</div>';
						annonce +='				</div>';
						annonce +='				<div class="caseoa">';
						annonce +='				</div>';
						annonce +='			</div>';
						annonce +='					<div class="interi">';						
						annonce +='						<div class="interi2">';							
						annonce +='							<div class="boutin2">';
																if(jsonn.org != 'evenement'){
																	annonce +='<a href="detail_produit.php?anne=' + jsonn[i].idPaki + '">Voir</a>';
																}else{
																	annonce +='<a href="evenement/detail_offre_evenement.php?anne=' + jsonn[i].idPaki + '&amp;post=' + jsonn[i].evenement + '">Voir</a>';
																}								
						annonce +='							</div>';
						annonce +='						</div>';						
						annonce +='					</div>';
					}
				}
				document.getElementById("normal").style.display='none';
				document.getElementById("loadersearching").style.display='none';
				$("#filtre").html(annonce);
				document.getElementById("filtre").style.display='block';
			});
		}
	});

});