function data()
{
	if (/[A-Za-z0-9]/.test($('#pseudo').val()) && /[A-Za-z0-9]/.test($('#avis').val())) 
	{
		var avis = $('#avis').val();
		var id =  $('input[type=radio][name=number]:checked').attr('id');
		var note =  $('input[type=radio][name=number]:checked').attr('value');
		var color = $('label[for=' + id + ']').css('color');
		var ladate = new Date()
		var date = ladate.getDate()+"/"+(ladate.getMonth()+1)+"/"+ladate.getFullYear()+" "+ladate.getHours()+":"+ladate.getMinutes();
		var pseudo = $('#pseudo').val();
		var p = document.createElement('p');
		var p2 = document.createElement('p');
		var p0 = document.createElement('p');
		var p3 = document.createElement('p');

		var button = document.createElement('button');
		var button_del = document.createElement('input');
		var fieldset = document.createElement('fieldset');
		var div = document.createElement('div');
		var text0 = document.createTextNode("Par "+pseudo);
		var text = document.createTextNode(note+"/10");
		var text3 = document.createTextNode("Commentaire : "+avis);
		
		var text2 = document.createTextNode(date);
		var hr = document.createElement('hr');


		button_del.setAttribute("type", "submit");
		button_del.setAttribute("value", "Supprimé");
		button_del.setAttribute("onclick", "del()");
		
		fieldset.setAttribute("id", "delete")
		button_del.setAttribute("style", "margin-left: 27em");

		p.setAttribute("id", "note");
		var color2 = "color:"+color;

		p.setAttribute("style", color2);

		p0.setAttribute("style", "color: white")
		p2.setAttribute("style", "color: white")
		p3.setAttribute("style", "color: white")

		div.appendChild(hr);
		

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
		var search = document.getElementsByClassName('about-links');
		search[0].appendChild(fieldset);
	}

	else
		alert("PSEUDO ou COMMENTAIRE à caractéres incorrect");

}