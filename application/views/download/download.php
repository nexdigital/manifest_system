<script type="text/javascript" src="<?=base_url()?>asset/javascript/pdfobject.js"></script>
<script type='text/javascript'>

  function embedPDF(){

    var myPDF = new PDFObject({ 

      url: 'http://www.pdfobject.com/generator.php'

    }).embed();  

  }

  window.onload = embedPDF; //Feel free to replace window.onload if needed.

</script>