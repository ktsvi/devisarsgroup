$("#formatChange").on("change", function(event){  
   var format = document.getElementById("formatChange").value;

   if(format === "125 ml"){//alert(format);
      document.getElementById("prixUnitaire").value=125;
   }else if(format === "0.5 l"){
      document.getElementById("prixUnitaire").value=90;
   }else if(format === "1 l"){
      document.getElementById("prixUnitaire").value=115;
   }else if(format === "1.5 l"){
      document.getElementById("prixUnitaire").value=120;
   }else if(format === "5 l"){
      document.getElementById("prixUnitaire").value=425;
   }else if(format === "10 l"){
      document.getElementById("prixUnitaire").value=1100;
   }else{
      document.getElementById("prixUnitaire").value=2100;
   }
     
});


//Global var 
var nature= new Array();
var stock = new Array();

var dateD= new Array();
var depense = new Array();


/* $("#formatChange").on("change", function(event){  
var format = document.getElementById("formatChange").value;
if(format=="1 l"){
   $('#prixUnitaire').html(115);
} 
}); 


/*Chart function for sales strengh
$(document).ready(function() {
 // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
// demo.initChartsSales();
});  */



/*


function loadChartSalesFrequences(){
   $(document).ready(function(){
      $.ajax({  
         url:'/stockParTypeDeauProduit',  
         type:'POST',   
         dataType:'json',  
         async:true,  
         success: function(data, status) {  
         //  alert(data);
           var d = new Date();
           var montant = new Array();
           var nature = new Array();
           var dateDepense = new Array();
            for(i = 0; i < data.length; i++) {  
               pay = data[i];  
              nature[i]=pay['nature'];
              stock[i]=pay['quantiteProduction'];
              dateD[i]=pay['dateProduction'].date;
               demo.initChartsSales();
            }   
        
        },  
         error : function(xhr, textStatus, errorThrown) {  
            alert('Chart process is not finished');  
         }  
  }); 
  });  
}

$(document).ready(function(){
   $.ajax({  
      url:'/stockTotalActuelProduit',  
      type:'POST',   
      dataType:'json',  
      async:true,  
      success: function(data, status) {  
  //alert(data);
        var d = new Date();
        var quantiteEauRestant = 0;
        var nom="";
        var prenom="";
        var ville="";
         for(i = 0; i < data.length; i++) {  
            p = data[i];  
            if(p['nomVille']==p['villeUser']){
               quantiteEauRestant += p['quantiteRestante'];
               nom = p['firstName'];
               prenom = p['name'];
               ville = p['nomVille'];
              $('#contentTabStock').append("<tr id='contentTabStock'><td>"+p['nature']+"</td><td><b>"+p['quantiteInitiale']+"</b></td><td color='green'><font color='green'><b>"+p['quantiteVendue']+"</b></font></td><td><font color='red'><b>"+p['quantiteRestante']+"</b></font></b></td></tr>");
            } 
            }
            $('#idStock').html(quantiteEauRestant+' L');
            $('#name').html(nom);
            $('#ville').html(ville);
         },  
      error : function(xhr, textStatus, errorThrown) {  
         alert('Table process is not finished');  
      }  
}); 
});
//calcul du stock
$(document).ready(function(){
   $.ajax({  
      url:'/calculNombreClient',  
      type:'POST',   
      dataType:'json',  
      async:true,  
      success: function(data, status) {  
        //alert(data);
        var nombreClient=0;
         for(i = 0; i < data.length; i++) {  
            pay = data[i]; 
            nombreClient = pay['nombreClient']
         }   
         $('#nombreClient').html(nombreClient);
     },  
      error : function(xhr, textStatus, errorThrown) {  
         alert('Count process isn\'t ready');  
      }  
}); 
});  


//calcul du stock
$(document).ready(function(){
   $.ajax({  
      url:'/clientModele',  
      type:'POST',   
      dataType:'json',  
      async:true,  
      success: function(data, status) {  
       // alert(data);
       var nomclientModele="";
       var prenomclientModele="";
       for(i = 0; i < data.length; i++) {  
            pay = data[i]; 
            nomclientModele = pay['nomClient']
            prenomclientModele = pay['prenomClient']
            versement = pay['versement']
         }   
         //alert(prenomclientModele);
       // var c = nomclientModele+' '+prenomclientModele;
       $('#clientModel').html(nomclientModele);
       $('#montantclientModel').html(versement);
       
     },  
      error : function(xhr, textStatus, errorThrown) {  
         alert('Count process isn\'t ready');  
      }  
}); 
});  


//research function for customer 
$("#btnSearchProduction" ).on('click', function() {
var productionResearch=document.getElementById("productionPerDateResearch").value;
//alert(productionResearch);

$.ajax({  
   type:'POST',
   url :'/productionresearchlist',
   dataType:'html',    
   data: { "prod" : productionResearch },
   success: function(data, status) { 
      alert(data);
     //  $('#stubborn').append('<thead id="stubborn" class=" text-primary"><th>Nom</th><th>Prénom</th> <th>Sexe</th><th>Email</th> <th>Tel</th><th>Ville</th> <th>Modifier</th><th>Supprimer</th></thead>');
     for(i = 0; i < data.length; i++) {  
         p = data[i];  
        $('#tableContent').replaceWith("<tr id='"+i+"'><td>"+p['dateProduction']+"</td><td>"+p['nature']+"</td><td>"+p['quantiteProduction']+"</td><td>"+p['nomAgence']+"</td><td>"+p['nomVille']+"</td><td>"+p['nomEmploye']+" "+p['nomEmploye']+" </td><td onclick='return(confirm('Voulez-vous modifier cette production ?'));' colspan='2'><a href ='{{ path('up_production', { 'id' : x.id }) }}'>Modifier |</a><a onclick='return(confirm('Voulez-vous supprimer cette production ?'));' href ='{{ path('del_production', {'id' : x.id }) }}'>Supprimer</a></td></tr>");

      } 
   },
   error : function(xhr, textStatus, errorThrown) {  
      alert('La requête a échoué, réessayer ou contacter l\'admin .');  
   }  
});  

});

//computing unit price
$( "#homebundle_acheter2_quantiteAchat2" ).on('change', function() {
var emballageId=document.getElementById("homebundle_acheter2_emballage").value;
var quantiteAchat=document.getElementById("homebundle_acheter2_quantiteAchat2").value;

$.ajax({  
   type:'POST',
   url :'/findEmballagebyId',
   dataType:'json',    
   data: { "emballageId" : emballageId },
   success: function(data, status) { 
      //alert(data);
      var total = 0;
      for(i = 0; i < data.length; i++) {  
         p = data[i];  
         total = (p['prixdeVente'] * quantiteAchat);
      } 
       //alert(total);
       document.getElementById('homebundle_acheter2_prixUnitaire').value = total;
   },
   error : function(xhr, textStatus, errorThrown) {  
      alert('Quelque chose à mal tourné sur le serveur, réessayer ou contacter l\'admin .');  
   }  
});  
}); 


//computing unit price
$( "#homebundle_acheter1_quantiteAchat1" ).on('change', function() {
   var emballageId=document.getElementById("homebundle_acheter1_emballage").value;
   var qteAchete=document.getElementById("homebundle_acheter1_quantiteAchat1").value;
   var clientId = document.getElementById("homebundle_acheter1_client").value;

   $.ajax({  
      type:'POST',
      url :'/findEmballagebyId',
      dataType:'json',    
      data: ({ 
         "emballageId" : emballageId,
         "clientId" : clientId
        }),
      success: function(data, status) { 
        // alert(data);
         var total = 0;
         var typeEmballage="";
         var totalAchatClient=0;
         var format=0;
         var prixdeVente=0;
         for(i = 0; i < data.length; i++) {  
            p = data[i];  
            prixdeVente = p['prixdeVente'];
            typeEmballage = p['typeEmballage'];
            totalAchatClient = p['quantiteTotalAchetee'];
            format=p['format'];
         } 
         if(typeEmballage="Recyclable" && totalAchatClient > 300){
          document.getElementById('homebundle_acheter1_prixUnitaire').value = qteAchete * format * 100;          
         }else if(typeEmballage=="Recyclable" && totalAchatClient < 300){ 
          document.getElementById('homebundle_acheter1_prixUnitaire').value = qteAchete * format * 200;
         }else if(typeEmballage!="Recyclable"){  
          document.getElementById('homebundle_acheter1_prixUnitaire').value = prixdeVente * qteAchete;
         }
         },
      error : function(xhr, textStatus, errorThrown) {  
         alert('Une requête a mal fonctionné.');  
      }  
   });  
   }); 

   
//research function for customer 
$("#btnSearchProduction" ).on('click', function() {
   var productionResearch=document.getElementById("productionPerDateResearch").value;
   //alert(productionResearch);
   $.ajax({  
      type:'POST',
      url :'/productionresearchlist',
      dataType:'html',    
      data: { "prod" : productionResearch },
      success: function(data, status) { 
         //alert(data);
          $('#stubborn').append('<thead id="stubborn" class="text-primary"><th>Nom</th><th>Prénom</th> <th>Sexe</th><th>Email</th> <th>Tel</th><th>Ville</th> <th>Modifier</th><th>Supprimer</th></thead>');
        for(i = 0; i < data.length; i++) {  
            p = data[i];  
           $('#tableContent').replaceWith("<tr id='"+i+"'><td>"+p['dateProduction']+"</td><td>"+p['nature']+"</td><td>"+p['quantiteProduction']+"</td><td>"+p['nomAgence']+"</td><td>"+p['nomVille']+"</td><td>"+p['nomEmploye']+" "+p['nomEmploye']+" </td><td onclick='return(confirm('Voulez-vous modifier cette production ?'));' colspan='2'><a href ='{{ path('up_production', { 'id' : x.id }) }}'>Modifier |</a><a onclick='return(confirm('Voulez-vous supprimer cette production ?'));' href ='{{ path('del_production', {'id' : x.id }) }}'>Supprimer</a></td></tr>");
   
         } 
      },
      error : function(xhr, textStatus, errorThrown) {  
         alert('La requête a échoué, réessayer ou contacter l\'admin .');  
      }  
   });  
   
   });   

//research function for ""livraison emb ""
$("#btnSearchLivraison" ).on('click', function() {
   var livraisonPerDateLivraison=document.getElementById("livraisonPerDateLivraison").value;
   //alert(livraisonPerDateLivraison);
   $.ajax({  
      type:'POST',
      url :'/livraisonResearchlist',
      dataType:'json',    
      data: { "livDate" : livraisonPerDateLivraison },
      success: function(data, status) { 
        // alert(data);
        //  $('#newTable').replaceWith('<div id="state" class="table-responsive" style="background-color:white">');
          $('#stubborn').replaceWith('<thead id="stubborn" class="text-primary"><th>Date de Livraison</th><th>Fournisseur</th> <th>Format livré</th><th>Quantité</th><th>Ville</th><th>Actions</th>');
        for(i = 0; i < data.length; i++) {  
            p = data[i];  
           $('#newValues').replaceWith("<tr id='"+i+"'><td>"+p['dateLivraison'].date+"</td><td>"+p['nomFournisseur']+"</td><td>"+p['format']+"</td><td>"+p['quantiteLivraison']+"</td><td>"+p['villeLivraison']+"</td><td onclick='return(confirm('Voulez-vous modifier cette production ?));' colspan='2'><a href ='upLivraisonEmballage"+p['id']+"'> Modifier | </a><a href ='delLivraisonEmballage"+p['id']+">Supprimer</a></td></tr>");
         } 

      },
      error : function(xhr, textStatus, errorThrown) {  
         alert('La requête a échoué, réessayer ou contacter l\'admin .');  
      }  
   });     
   });    

//research function for dynamic expenses list  
$( "#btnFilterExpenseByDate").on("click", function(event) {
	var inputStartDate=document.getElementById("inputStartDate").value;
   var inputEndDate=document.getElementById("inputEndDate").value;
	//alert("debut="+inputStartDate+" date fin "+inputEndDate);
   $.ajax({  
      type:'POST',
      url :'/expenseStateByInputDate',
      dataType:'json',    
      data: ({ 
             "inputStartDate" : inputStartDate,
             "inputEndDate" : inputEndDate
            }),
      success: function(data, status) { 
     //  alert(data);
      var expense = 0;
      var now = new Date();
      var annee   = now.getFullYear();
      var mois    = now.getMonth() + 1;
      var jour    = now.getDate();
      var heure   = now.getHours();
      var minute  = now.getMinutes();
      var seconde = now.getSeconds();
      
       $('#expTable').replaceWith('<table id="expTable" class = "table" boder="1"> <thead> <th colspan="6"><b><font color="#ef8157">Dépenses durant la période allant du <i>'+inputStartDate+' au '+inputEndDate+'</i></font><b><th></thead> <thead class="text-primary"><th>N°</th><th>Date</th><th colspan="2">Motif de la dépense</th><th>Description</th><th>Montant</th></thead>  ');
       for(i = 0; i < data.length; i++) {  
         p = data[i];  
         expense = expense + p['montantdepense'];
         $('#expTable').append("<tr><td>"+p['id']+"</td><td>"+p['datedepense'].date+"</td><td colspan='2'>"+p['libelledepense']+"</td><td>"+p['descmontant']+"</td><td>"+p['montantdepense']+"</td></tr>");
      } 
      $('#expTable').append('<thead><th colspan="2"><center>------------------------------------------------------------</br><center><b>Dépenses périodique : <font color="red"> '+expense+' FCFA</font><b></center><br><center>------------------------------------------------------------</th><th colspan="3"><b> Imprimé le : '+jour+'/'+mois+'/'+annee+' à '+heure+':'+minute+' </b></th></thead></table>');
      },
      error : function(xhr, textStatus, errorThrown) {  
         alert('Un problème est survenu, réessayer ou contacter l\'admin!!!');  
      }  
   });  
});  
*/



   /*
$(document).ready(function(){

    $.ajax({  
       url:        '/nbofcustomer',  
       type:       'POST',   
       dataType:   'json',  
       async:      true,  
       success: function(data, status) {  
        var nbc=0;
          for(i = 0; i < data.length; i++) {  
              nbc +=1;
          }
          $('#nbc').html(nbc);  
         // alert(nbc);   
       },  
       error : function(xhr, textStatus, errorThrown) {  
          alert('Ajax request failed.');  
       }  
   }); 
  //number of provider
   $.ajax({  
      url:        '/nbofprovider',  
      type:       'POST',   
      dataType:   'json',  
      async:      true,  
      success: function(data, status) {  
      // alert('p'+data);
      var nbf=0;
         for(i = 0; i < data.length; i++) {  
            nbf +=1;
         }
         $('#nbf').html(nbf);  
      // alert(nbc);   
      },  
      error : function(xhr, textStatus, errorThrown) {  
         alert('Ajax request failed.');  
      }  
   }); 
 
   //return rest of current band
   $.ajax({  
      url:        '/currentband',  
      type:       'POST',   
      dataType:   'json',  
      async:      true,  
      success: function(data, status) {  
        // alert(data);
        for(i = 0; i < data.length; i++) {  
            p = data[i];  
            var total = p['bandSize'] * p['bandunitPrice'];
            var restSizeOfBand = p['bandSize'] - p['totalsizeofLot'];
            $('#currentbandid').html(restSizeOfBand); 
            var bandcard=document.getElementById("bandcard");
            var currentbandid=document.getElementById("currentbandid");
            //emission d'alerte de stock
            if(restSizeOfBand > 100){
            bandcard.style.background="red";
            currentbandid.style.color="orange";
            $("#currentbandid").fadeOut(900).delay(200).fadeIn(800);
            }
        } 
      },
      error : function(xhr, textStatus, errorThrown) {  
         alert('La requête a échoué, réessayer ou contacter l\'admin .');  
      }  
   });  
*/


//Print function
function printRevenues(divID) {
//Get the HTML of div
var divElements = document.getElementById(divID).innerHTML;
//Get the HTML of whole page
var oldPage = document.body.innerHTML;
//Reset the pages HTML with divs HTML only
document.body.innerHTML = "<html><head><title></title></head><body><center><img src='img/logo.PNG' width='20%' width='20%'/><br><b>FERME xxx</b><br><hr><b>BILAN DES REVENUS DE LA FERME</b></center><hr> <br>" + divElements + "</body>";
//Print Page
window.print();
//Restore orignal HTML
document.body.innerHTML = oldPage;
}

//Print expenses function
function printerExpenses(divID) {
//Get the HTML of div
var divElements = document.getElementById(divID).innerHTML;
//Get the HTML of whole page
var oldPage = document.body.innerHTML;
//Reset the pages HTML with divs HTML only
document.body.innerHTML = "<html><head><title></title></head><body><center><img src='img/logo.PNG' width='20%' width='20%'/><br><b>FERME xxx</b><br><hr><b>BILAN DES DEPENSES</b></center><hr> <br>" + divElements + "</body>";
//Print Page
window.print();
//Restore orignal HTML
document.body.innerHTML = oldPage;
}


/*
//Print expenses function
function printBill(divID) {
//Get the HTML of div
 var divElements = document.getElementById(divID).innerHTML;
//Get the HTML of whole page
var oldPage = document.body.innerHTML;
//Reset the pages HTML with divs HTML only
document.body.innerHTML = "<html><head><title></title></head><body><center><img src='img/logo.PNG' width='20%' width='20%'/><br><b>FERME xxx</b><br><hr><b>FACTURE PARTIELLE - ACHAT DE LOT </b></center><hr><br>  <table id='pTable' class ='table'><thead class='text-primary'><th>Facture N°</th><th>Date d'Achat</th><th>Paiement</th><th><font color='red'><b>Reste à Payer</b></font></th><th>Lot (Taille)</th><th>Client</th><th>Téléphone</th></thead><tr>" + divElements+ "</table> </body>";
//Print Page
window.print();
//Restore orignal HTML
document.body.innerHTML = oldPage;
}

/*$("#client").on("change", function(event){ 
   alert('cest fait!');
  });
*/


//Print function
function printMachine(divID, target) {
//Get current date
var now = new Date();
var annee   = now.getFullYear();
var mois    = now.getMonth() + 1;
var jour    = now.getDate();
var heure   = now.getHours();
var minute  = now.getMinutes();
var seconde = now.getSeconds();
//alert( "Impression : "+jour+"/"+mois+"/"+annee+" à "+heure+":"+minute+"m:"+seconde+"s" );
//Get the HTML of div
var divElements = document.getElementById(divID).innerHTML;
//Get the HTML of whole page
var oldPage = document.body.innerHTML;
//Reset the pages HTML with divs HTML only
document.body.innerHTML = "<html><head><title></title></head><body><center><img src='img/logo.PNG' width='10%' width='10%'/><br><b>CLAUDI BIO WATER</b><br><hr><b>"+target+"</b></center><hr> <br>" + divElements + "<hr><p align='right'>Imprimé le : "+jour+"/"+mois+"/"+annee+" à "+heure+"h:"+minute+"m:"+seconde+"s <i></i></p></body>";
//Print Page
window.print();
//Restore orignal HTML
document.body.innerHTML = oldPage;
}

//message
$(document).ready(function() {
$('#successMsg').fadeIn(1000);
$('#successMsg').fadeOut(10000);
});


//anime un message d'alert
function FaireClignoterNbPoule (){ 
$("#currentbandid").fadeOut(900).delay(300).fadeIn(800); 
} 

//anime un message d'alert
function FaireClignoterImage (){ 
 $("#alertmsg").fadeOut(900).delay(300).fadeIn(800); 
} 
$(document).ready(function(){ 
  setInterval('FaireClignoterImage()',2200); 
});








