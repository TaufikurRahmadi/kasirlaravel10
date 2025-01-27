document.addEventListener("DOMContentLoaded", function () {
    var currentPage = window.location.href;

    if (currentPage.includes("data_mahasiswa")) {
        document.getElementById("dashboardTitle").innerText = "Mahasiswa";
    } else if (currentPage.includes("data_jurusan")) {
        document.getElementById("dashboardTitle").innerText = "Jurusan";
    }else if (currentPage.includes("data_operator")){
        document.getElementById("dashboardTitle").innerText = "operator";
    }else if (currentPage.includes("tambah_jurusan")){
        document.getElementById("dashboardTitle").innerText = "tambah jurusan";
    }
    else if (currentPage.includes("tambah_operator")){
        document.getElementById("dashboardTitle").innerText = "tambah operator";
    } else if (currentPage.includes("tambah_mahasiswa")){
        document.getElementById("dashboardTitle").innerText = "Tambah Mahasiswa";
    }
});