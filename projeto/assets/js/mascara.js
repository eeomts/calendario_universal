function mascara(o,f){
    v_obj = o
    v_fun = f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value = v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2");
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");
    return v;
}
function mcnpj(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dígitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dígitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hífen depois do bloco de quatro dígitos
    return v
}
function mcpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}
function mcep(v){
    v=v.replace(/\D/g,"")
    v=v.replace(/^(\d{5})(\d)/,"$1-$2")
    return v
}
function msite(v){
    v=v.replace(/^http:\/\/?/,"")
    dominio=v
    caminho=""
    if(v.indexOf("/")>-1)
        dominio=v.split("/")[0]
        caminho=v.replace(/[^\/]*/,"")
    dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
    caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
    caminho=caminho.replace(/([\?&])=/,"$1")
    if(caminho!="")dominio=dominio.replace(/\.+$/,"")
    v="http://"+dominio+caminho
    return v
}

function mdinheiro(v) {
	v=v.replace(/\D/g,"")
	v=v.replace(/(\d{1})(\d{14})$/,"$1.$2")
	v=v.replace(/(\d{1})(\d{11})$/,"$1.$2")
	v=v.replace(/(\d{1})(\d{8})$/,"$1.$2")
	v=v.replace(/(\d{1})(\d{5})$/,"$1.$2")
	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2")
	return v;
}

function mdata(v){
    v=v.replace(/\D/g,"");           
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    v=v.replace(/(\d{4})(\d)/,"$1/$2");
    return v;
}
//cpf & cnpj -> mateus
function mdoc(v) {
  v = v.replace(/\D/g, '');
  if (v.length <= 11) {
    return mcpf(v);
  } else {
    return mcnpj(v);
  }
}

//RG
function mrg(v){
    v = v.replace(/\D/g,"");
    v = v.replace(/(\d{2})(\d)/,"$1.$2");
    v = v.replace(/(\d{3})(\d)/,"$1.$2");
    v = v.replace(/(\d{3})(\d{1})$/,"$1-$2");
    return v;
}


//placa de carro mercosul
function mplaca(v){
    v = v.replace(/[^A-Za-z0-9]/g,"").toUpperCase();
    v = v.replace(/^([A-Za-z]{3})(\d)/, "$1-$2");
    return v;
}


//nomes
function mnome(v){
    return v
        .toLowerCase()
        .replace(/(?:^|\s)\S/g, function(l){ return l.toUpperCase(); });
}

//apenas letras
function mletters(v){
    return v.replace(/[^a-zA-ZÀ-ÿ ]/g,"");
}

// cartoes bancarios
function mcc(v){
    v = v.replace(/\D/g,"");
    v = v.replace(/(\d{4})(?=\d)/g, "$1 ");
    return v.trim();
}