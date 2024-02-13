function previsualizar(){
    const portada=document.querySelector("#portada");
    const previsualizar =document.querySelector("#previsualizar");
    const archivo= portada.files[0];
   

    if (!archivo||archivo.length){
        previsualizar.src="";
        return;
    }else{
    const objectURL=URL.createObjectURL(archivo);
   
    previsualizar.src=objectURL;
    }
}