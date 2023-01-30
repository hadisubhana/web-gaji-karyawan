function getValue(elem) {
    var formName = $(elem).closest('form').attr('name');
    return formName;
}

const fName = {
    TDK: "tambah-data-karyawan",
    TEDK: "tambah-edit-data-karyawan"
}

function sel(name) {
    return $('[name="' + name + '"]');
}

function insert(formName) {

    let ajax;

    // if (formName == fName.TDK) {
    sel(formName).one('submit', (e) => {
        e.preventDefault();
        e.disabled = true;

        var data = sel(formName).serialize();

        ajax = $.ajax({
            url: 'php/process.php?name=' + formName,
            type: 'post',
            data: data
        });

        ajax.done(function (response, textStatus, jqXHR) {
            let json = JSON.parse(response);
            alert(json.message);
            if ((json.status == 'ok') || (json.status == 'exist')) sel(formName)[0].reset();
        });

        ajax.fail(function () {
            alert('There is error while submit');
        });

        ajax.success(function () {
            e.disabled = false;
        })
    });
    // } else if (formName == fName.TEDK) {
    //     sel(formName).one('submit', (e) => {
    //         e.preventDefault();
    //         e.disabled = true;

    //         var data = sel(formName).serialize();

    //         ajax = $.ajax({
    //             url: 'php/process.php?name=' + formName,
    //             type: 'post',
    //             data: data
    //         });

    //         ajax.done(function (response, textStatus, jqXHR) {
    //             let json = JSON.parse(response);
    //             alert(json.message);
    //             if(json.status == 'ok') sel(formName)[0].reset();
    //         });

    //         ajax.fail(function () {
    //             alert('There is error while submit');
    //         });

    //         ajax.success(function() {
    //             e.disabled = false;
    //         })
    //     });
    // }
}

var myModalEl = document.getElementById('exampleModal')
if (myModalEl) {
    myModalEl.addEventListener('hidden.bs.modal', function (event) {
        location.reload()
    });
}
