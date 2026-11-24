$(document).ready(function() {
    $('#table-dosen').dataTable({
        responsive: true,
    });
});

$(document).ready(function() {
    $('#table-bahan').dataTable({
        responsive: true,        
    });
});

$(document).ready(function() {
    $('#table-addAsisten').dataTable({
        responsive: true,        
    });
});


function fnClickAddRow() {
    $('#editable').dataTable().fnAddData( [
        "Custom row",
        "New row",
        "New row",
        "New row",
        "New row" ] );

}

$(document).on('click', '#form-nilai', function() {
    let idprt = $(this).data('idprt');    
    let idanggota = $(this).data('idanggota');    
    let iddosen = $(this).data('iddosen');    
    let mk = $(this).data('mk');
    let jadwal = $(this).data('jadwal');
    
    $("#anggota").val(idanggota);
    $("#dosen").val(iddosen);
    $("#prt").val(idprt);
    $("#mk").val(mk);
    $("#jadwal").val(jadwal);
    /* Act on the event */
});

// $(document).on('click', '#putarVideoDashboard', function(e) {
//     console.log(e);
//     // e.target.autoplay=true;
//     /* Act on the event */
// });

$(document).on('click','#ambilIdAnggota', function() {
    let idanggota = $('#ambilIdAnggota option:selected').attr("idAng");
    console.log(idanggota);
    $("#idanggota").val(idanggota);
    /* Act on the event */
});

$(document).on('click','#lihatPassword', function() {
    if ($(this).is(':checked')) {
        $('#password').attr('type', 'text');
        $('#passwordLogin').attr('type', 'text');
        $('#passwordBaru').attr('type', 'text');
        $('#konfirmasiPassword').attr('type', 'text');
    }else{        
        $('#password').attr('type', 'password');
        $('#passwordLogin').attr('type', 'password');
        $('#passwordBaru').attr('type', 'password');
        $('#konfirmasiPassword').attr('type', 'password');
    }
}); 

$(document).on('click','#tombolVideo', function() {
    const putar = $(this).data('putar');
    const hasil = putar.split("/");
    const akhir = hasil.length-1;
    const ekstensi = hasil[akhir].split(".");
    
    console.log(putar);

    $("#isiMedia").html('');

    if (ekstensi[1] == "MP4" || ekstensi[1] == "mkv" || ekstensi[1] == "3gp" || ekstensi[1] == "mp4"){
         // || "mkv" || '3gp' || 'mpeg'
        $("#isiMedia").html(`
                <video src="`+putar+`" autoplay controls></video>
            `);        
    }else if (ekstensi[1] == "jpeg" || ekstensi[1] == "jpg" || ekstensi[1] == "png") {
         // || "png" || 'jpg'
        $("#isiMedia").html(`
                <img class="img-thumbnail" src="`+putar+`" width="600px">
            `);
    }else{
        $("#isiMedia").html(`<div class="alert alert-warning"><h4>Maaf, type file tidak didukung</h4></div>`);
    }

    /* Act on the event */
});