var basic_info_div = document.getElementById("basic_infomation");
var admin_div = document.getElementById("administrator_div");
var student_div = document.getElementById("student_div");
var organizer_div = document.getElementById("organizer_div");

var student_radio = document
  .getElementById("student")
  .addEventListener("change", e => {
    basic_infomation.style.display = "block";
    student_div.style.display = "block";
    admin_div.style.display = "none";
    organizer_div.style.display = "none";
  });

var academic_radio = document
  .getElementById("academic_staff")
  .addEventListener("change", e => {
    basic_infomation.style.display = "block";
    admin_div.style.display = "none";
    organizer_div.style.display = "block";
    student_div.style.display = "none";
  });

var temp_academic_radio = document
  .getElementById("temp_academic_staff")
  .addEventListener("change", e => {
    basic_infomation.style.display = "block";
    admin_div.style.display = "none";
    organizer_div.style.display = "block";
    student_div.style.display = "none";
  });

var admin_radio = document
  .getElementById("administrator")
  .addEventListener("change", e => {
    basic_infomation.style.display = "none";
    admin_div.style.display = "block";
    organizer_div.style.display = "none";
    student_div.style.display = "none";
  });
