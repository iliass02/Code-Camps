function data()
{
	
	if (/[A-Za-z0-9]/.test($('#pseudo').val()) && /[A-Za-z0-9]/.test($('#avis').val())) 
	{

		var avis = $('#avis').val();
		var id =  $('input[type=radio][name=number]:checked').attr('id');
		var note =  $('input[type=radio][name=number]:checked').attr('value');
		var color = $('label[for=' + id + ']').css('color');
		var ladate = new Date()
		var date = ladate.getDate()+"/"+(ladate.getMonth()+1)+"/"+ladate.getFullYear()+" "+ladate.getHours()+":"+("0" + ladate.getMinutes()).substr(-2);
		var pseudo = $('#pseudo').val();


		var p = document.createElement('b');
		var p2 = document.createElement('p');
		var p0 = document.createElement('p');
		var p3 = document.createElement('p');
		var button_del = document.createElement('input');
		button_del.setAttribute("type", "submit");
		button_del.setAttribute("value", "Supprimé");
		button_del.setAttribute("onclick", "del()");
		var fieldset = document.createElement('fieldset');
		fieldset.setAttribute("id", "delete");
		var div = document.createElement('div');
		var text0 = document.createTextNode("Par "+pseudo);
		var text = document.createTextNode(note+"/10");
		var text2 = document.createTextNode(date);
		var text3 = document.createTextNode("Commentaire : "+avis);

	
		

		p.setAttribute("id", "note");
		var color2 = "color:"+color;

		p.setAttribute("style", color2);

		p0.setAttribute("style", "color: white")
		p2.setAttribute("style", "color: white")
		p3.setAttribute("style", "color: white")



		fieldset.setAttribute("id", "delete");
		button_del.setAttribute("style", "margin-left: 92em");

		p0.appendChild(text0);
		p.appendChild(text);
		p2.appendChild(text2);
		p3.appendChild(text3);
		
		div.appendChild(p0);
		div.appendChild(p);
		div.appendChild(p3);
		div.appendChild(p2);
		div.appendChild(button_del);
		fieldset.appendChild(div);
		document.body.appendChild(fieldset);

		$('div:eq(1)').hide();

		$('div:eq(1)').slideDown('3000');
	}

	else
		alert("PSEUDO ou COMMENTAIRE à caractéres incorrect");

}