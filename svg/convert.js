
(function(){
  var $canvas = document.querySelector("canvas");
  var context = $canvas.getContext("2d");
  var $input = document.querySelector("input[type=file]");

  var setDownload = function(file_name) {
    var $download = document.querySelector("#download");
    $download.download = file_name;
    $download.href =  $canvas.toDataURL("image/png");
    $download.hidden = false;
  }
  
  var readImage = function(file){
    var reader = new FileReader();
    
    reader.onload = function(e){
      var img = new Image();
      img.onload = function(){
        $canvas.width=img.width;
        $canvas.height=img.height;
        context.drawImage(img, 0, 0);
      setDownload(file.name+".png")
      }
      img.src = e.target.result;
    }

    reader.readAsDataURL(file);
  }

  //Load things on change
  $input.addEventListener("change", function(e) {
    var file = e.target.files.item(0);
    if (file && file.type.match("image.*")) {
      readImage(file);
    }
  });
})();
