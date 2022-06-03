 	function valida_reset_senha()
	{
		var password = document.getElementById('reset_password_id').value
		var password2 = document.getElementById('reset_password_id2').value

          if(password != password2)
		  { 
             alert("As senhas não correspondem! Verifique as senhas.");
			 return false;
          }
		  
    }
 

function valida_ind_politica_de_uso(id){
				var status = document.getElementById(id);
				if (status.checked){
					status.value='S'
				}
				else{
					status.value='N'
				}
			}

function valida_ind_aceito_receber_info(id){
	var status = document.getElementById(id);
	if (status.checked){
		status.value='S'
	}
	else{
		status.value='N'
	}
} 

function validar_email_senha(){
	email = document.formulario.email.value
	email2 = document.formulario.email2.value
	senha = document.formulario.senha.value
	senha2 = document.formulario.senha2.value
	
	if (email == email2 && senha == senha2){
		return true
	}
	else{ 
		alert("Email ou senha digitados não correspondem.")
		return false
	}
	}
