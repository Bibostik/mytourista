const form = document.getElementById("new-story-form");
form.addEventListener("submit", (event) => {
  event.preventDefault();

  // Validate form inputs
  const title = document.getElementById("title").value.trim();
  const author = document.getElementById("author").value.trim();
  const content = document.getElementById("description").value.trim();
  const image = document.getElementById("image").files[0];

  if (!title || !author || !content) {
    alert("Please fill out all required fields.");
    return;
  }

  // Send form data to server using AJAX
  const xhr = new XMLHttpRequest();
  const formData = new FormData();
  formData.append("title", title);
  formData.append("author", author);
  formData.append("content", content);
  if (image) {
    formData.append("image", image);
  }

  xhr.open("POST", "addstory.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert("Story submitted successfully!");
      form.reset();
    }
  };

  xhr.send(formData);
});
