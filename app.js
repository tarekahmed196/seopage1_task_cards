// JavaScript for File Upload and Count
$("#fileInput").on("change", function () {
  console.log("File input changed");
  displayFiles(this.files, "fileList");
});

$("#uploadBtn").on("click", function () {
  console.log("Upload button clicked");
  uploadFiles();
});

function displayFiles(files, fileListId) {
  var fileList = document.getElementById(fileListId);
  fileList.innerHTML = ""; // Clear the previous list

  for (var i = 0; i < files.length; i++) {
    var listItem = document.createElement("li");
    var fileExtension = files[i].name.split(".").pop(); // Extract file extension
    listItem.textContent = files[i].name + " (" + fileExtension + ")";
    fileList.appendChild(listItem);
  }

  // Return the count of files
  return files.length;
}

function uploadFiles() {
  var formData = new FormData();
  var files = $("#fileInput")[0].files;

  for (var i = 0; i < files.length; i++) {
    formData.append("files[]", files[i]);
  }

  console.log("FormData:", formData);

  $.ajax({
    url: "http://localhost/server/upload.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      // Handle success response if needed
      console.log(response);

      // Update file count after successful upload
      updateFileCount();

      // Redirect to home page
      // window.location.href = "http://localhost/server/index.html";
    },
    error: function (error) {
      // Handle error response if needed
      console.error(error);
    },
  });
}

// Function to update the file count using Ajax
function updateFileCount() {
  $.ajax({
    url: "http://localhost/server/getFileCount.php", // Create a new PHP file for this purpose
    type: "GET",
    success: function (count) {
      // Update the file count in the span tag
      $("#fileCount").text(count);
    },
    error: function (error) {
      console.error(error);
    },
  });
}
