/**
 * 
 */
function assignSimpleAjaxQueryEvent(){
$(".simple-ajax-query").click(
		function(){
			var element=this;
			eval(element.dataset.callbefore)
			$.ajax({
				url:element.dataset.url,
				type: 'POST',
				data: element.dataset.queryparameters,
				dataType: 'html',
				success : function(code_html,statut){
					
					var result=document.getElementById(element.dataset.targetresult.substring(1));
					result.innerHTML=code_html;
					eval(element.dataset.callafter);
				
				},
				error : function(error,status){
					
				}
				}
			)
		});
}
assignSimpleAjaxQueryEvent();
function assignSimpleAjaxQueryOnLoadEvent(){
	$(".simple-ajax-query.onload").click(
			function(){
				var element=this;
				eval(element.dataset.callbefore)
				$.ajax({
					url:element.dataset.url,
					type: 'POST',
					data: element.dataset.queryparameters,
					dataType: 'html',
					success : function(code_html,statut){
						
						var result=document.getElementById(element.dataset.targetresult.substring(1));
						result.innerHTML=code_html;
						eval(element.dataset.callafter);
					
					},
					error : function(error,status){
						
					}
					}
				)
			});
	}