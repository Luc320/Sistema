function validar(){
    var d1 = new Date(document.getElementById('id_data').value)
    now = new Date();
    
    if(d1 > now){  
        document.getElementById('alert').innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <b> Proibido data futura! </b> </div>'; 
        setTimeout(limpaMsg,6000);
       return false;
   }
};


function limpaMsg(){
   document.getElementById("alert").innerHTML = "";
}

// Função para formatar em pontos e vírgula o campo "valor"
function formatarMoeda(){
var elemento = document.getElementById('id_valor');
var valor = elemento.value;

valor = valor + '';
valor = parseInt(valor.replace(/[\D]+/g, ''));
valor = valor + '';
valor = valor.replace(/([0-9]{2})$/g, ",$1");
valor = valor + '';

if (valor.length > 6 && valor.length < 10 ) {
    valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    valor = valor + '';

} 

switch (valor.length) {
    case 10:
        valor = valor.replace(/(\d{1})(\d{3})?(\d{3})/, "$1.$2.$3");
    case 11:
        valor = valor.replace(/(\d{2})(\d{3})?(\d{3})/, "$1.$2.$3");
    case 12:
         valor = valor.replace(/(\d{3})(\d{3})?(\d{3})/, "$1.$2.$3");
    case 13:
         valor = valor.replace(/(\d{1})(\d{3})(\d{3})?(\d{3})/, "$1.$2.$3.$4");
    case 14:
        valor = valor.replace(/(\d{2})(\d{3})(\d{3})?(\d{3})/, "$1.$2.$3.$4");
    case 15:
        valor = valor.replace(/(\d{3})(\d{3})(\d{3})?(\d{3})/, "$1.$2.$3.$4");
    default:
        //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
}

elemento.value = valor;
if(valor == 'NaN') elemento.value = '';

}


function altera(cod_movto,cod_ponto,cod_grupo,cod_descritivo,dat_movto,vlr_movto,obs_texto){

    document.getElementById('id_cod_movto').value = cod_movto;
    document.getElementById('cod_ponto_id').value = cod_ponto;
    document.getElementById('language').value = cod_grupo;
    document.getElementById('id_data').value = dat_movto;
    document.getElementById('languages-select').value = cod_descritivo;
    update(cod_descritivo)

    document.getElementById('id_valor').value = vlr_movto;
    document.getElementById('id_obs').textContent  = obs_texto;

};

function update( a_cod_descritivo ){

var select = document.getElementById('language')
//var select = document.querySelector('select');
var option = select.children[select.selectedIndex];
// var texto = option.textContent;
var texto = option.value;
// }

    // var btn = document.getElementById("btn");
    // btn.addEventListener("click", function () {
        //EXEMPLO UTILIZANDO JAVASCRIPT PURO

        var ajax = new XMLHttpRequest();
        var url =  '../generico/lista.php?cod_grupo=' +  texto;

        ajax.open("GET", url); //POST

        ajax.responseType = "json";

        // ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        ajax.send(); //"nome=guilherme&idade=32" (Exemplo com POST)

        ajax.addEventListener("readystatechange", function () {


            if (ajax.readyState === 4 && ajax.status === 200) {

                // console.log(ajax);
                // console.log(ajax.response);

                var resposta = ajax.response;
                // var lista = document.querySelector(".list");
                //console.log(resposta[i]);
                // for (var i = 0; i < resposta.length; i++) {
                //     lista.innerHTML += "<li>" + resposta[i] + "</li>";
                // }

                const languagesSelect = document.getElementById("languages-select");
                languagesSelect.options.length = 0; //limpa o select 
                const languagesList = resposta; 
            


                resposta.forEach((l)=>{
                    
                    if (l.substring(0,1) == a_cod_descritivo ){
                        option = new Option(l, l.selectedIndex,true);                    
                        languagesSelect.options[languagesSelect.options.length] = option;
                    } 
                })

                resposta.forEach((l)=>{
                    if (l.substring(0,1) != a_cod_descritivo ){
                        option = new Option(l, l.selectedIndex,false);                    
                        languagesSelect.options[languagesSelect.options.length] = option;
                    } 
                })



                // languagesList.forEach((language) => {
                //     // option = new Option(language, language.toLowerCase());
                //     option = new Option(language, language.toLowerCase());                    
                //     languagesSelect.options[languagesSelect.options.length] = option;
                    
                // });


            }

        });

    

}

