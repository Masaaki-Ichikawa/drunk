function imgPreView(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    var preview = document.getElementById("preview");
    var previewImage = document.getElementById("previewImage");
     
    if(previewImage != null) {
      preview.removeChild(previewImage);
    }
    reader.onload = function(event) {
      var img = document.createElement("img");
      img.setAttribute("src", reader.result);
      img.setAttribute("id", "previewImage");
      preview.appendChild(img);
    };
   
    reader.readAsDataURL(file);
  }

  function imgPreView_detail(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    var preview = document.getElementById("preview_edit");
    var previewImage = document.getElementById("previewImage_edit");
     
    if(previewImage != null) {
      preview.removeChild(previewImage);
    }
    reader.onload = function(event) {
      var img = document.createElement("img");
      img.setAttribute("src", reader.result);
      img.setAttribute("id", "previewImage_edit");
      preview.appendChild(img);
    };
   
    reader.readAsDataURL(file);
  }