<!-- HTML code for the image upload form and image display section -->
<style>

input[type=text] {
  transition: width 0.4s ease-in-out;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 16px;
  font-size: 16px;
  background-color: white;
  background-image: url('comments1.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  padding-left: 40px;
  padding: 12px 20px 12px 40px;
}

input[type=text]:focus {
  width: 100%;
}


.button {
  padding: 10px 15px;
  font-size: 12px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #60b8fe;
  border: none;
  border-radius: 15px;
  box-shadow: 0 5px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

input {
    margin-top: 1rem;
}

input::file-selector-button {
    font-weight: bold;
    color: dodgerblue;
    padding: 0.5em;
    border: thin solid grey;
    border-radius: 3px;
}


.button_delete {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
  border-radius: 9px;
}

.button_delete:hover {
  background-color: red;
  color: white;
}

.button_download {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
  border-radius: 9px;
}

.button_download:hover {
  background-color: green;
  color: white;
}


</style>


<div id="upload-form">
    <form id="myForm" method="post" enctype="multipart/form-data">
        <input type="text" name="caption" placeholder="Enter a caption">
        <input type="file" name="image" id="image">
        <button class="button" type="submit" name="submit" id="submit-btn">Upload</button>
    </form>
</div>

<div id="image-display">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    //submit form using AJAX
    $("#myForm").on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "upload.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //clear form fields and show success message
                $("#myForm")[0].reset();
                $("#upload-form").append("<p>Image uploaded successfully!</p>");
                //call function to load images
                loadImages();
            }
        });
    });
    //load images from database using AJAX
    function loadImages() {
        $.ajax({
            url: "load.php",
            type: "GET",
            success: function(data) {
                $("#image-display").html(data);
            }
        });
    }
    loadImages(); //call function to load images on page load
    //delete image using AJAX
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data("id");
        if(confirm("Are you sure you want to delete this image?")) {
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: {id:id},
                success: function(data) {
                    //show success message and update image display
                    $("#upload-form p").remove();
                    $("#upload-form").append("<p>Image deleted successfully!</p>");
                    loadImages();
                }
            });
        }
    });
});
</script>
