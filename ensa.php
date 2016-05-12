<html>
  <head>
    <script type="text/javascript">
      function imprimir(){
  var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}
    </script>
  </head>
  <body>
    <div id="imprimeme">
      <p>EncodingTheCode</p>
    </div>
    <button onclick="imprimir();">
  IMPRIMIR
</button>
  </body>
</html>