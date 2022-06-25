
$(function(){

    $('form input').on('keypress', function(e) {
        return e.which !== 13;
    });

    $('#transaction_search').keydown(function (e){

        if(e.keyCode == 13 && $('#param').is(":focus")){
            if($('#param').val() != "") {

                $('.btnTransactionSub').click();
            }

        }

    });


    if($('.select2')[0]){
        $('.select2').select2();
    }

    $('body').keydown(function (e){

        if(e.keyCode == 13){

            $('.btnSub').click();

        }

    });

});


String.prototype.stripSlashes = function(){
    return this.replace(/\\(.)/mg, "$1");
};

function unescapeHtml(safe) {
    return safe.replace(/&amp;/g, '&')
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>')
        .replace(/&quot;/g, '"')
        .replace(/&#039;/g, "'");
}

function getdate(type){

    var date = new Date();

    var year        = pad(date.getFullYear());
    var month       = pad(date.getMonth() + 1);
    var day         = pad(date.getDate());

    if(type == 'yyyymmdd'){

        return year + "-" + month + "-" + day;

    }else if(type == 'ddmmyyyy'){

        return day + "." + month + "." + year;

    }

    function pad(numb) {
        return (numb < 10 ? '0' : '') + numb;
    }

}

function get_uri(segment){

    var url = $(location).attr('href').split("/");
    return url[segment];
}

function core_form(route,reset_form, redirect = null, salert = null){

    var	params		=	$('form').serialize();
    var	query		=	$('form').serializeArray();
    obj             =   {};

    $(query).each(function(i, field){
        obj[field.name] = field.value;
    });

    var formData = new FormData($("#cform")[0]);

    $.ajax({

        type:'POST',
        url:route,
        cache: false,
        processData: false,
        contentType: false,
        data:formData,
        dataType: "json",
        beforeSend:function(data){

            $('._v_error').remove();
            $('input').css('border','1px solid #dee2e6');
            $('.btn').attr('disabled', true);
            $('.fa-spin').show();

        },
        success:function(data){

            $('.fa-spin').hide();
            $('.btn').attr('disabled', false);

            if(reset_form == 1){
                $('#cform')[0].reset();
            }

            Swal.fire({
                title: 'Başarılı',
                html: data.msg,
                icon: 'success',
                allowEscapeKey : false,
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kapat',
            }).then((result) => {

                if(redirect != null){

                    window.location=''+redirect+'';

                }

            });

            //window.location='/sysadmin';

        },
        error: function (data) {

            $('.btn').attr('disabled', false);

            if(salert != 1){

                $('.fa-spin').hide();
                console.log(data.responseJSON.errors);
                console.log(data.responseJSON);

                $.each(data.responseJSON.errors, function(key,value) {
                    $('#'+key).css('border','1px solid #e53232');
                    $('#'+key).after("<span class='_v_error' style='color:red;font-size:13px;'>* "+value+"</span>");
                });

            }else{

                $.each(data.responseJSON.errors, function(key,value) {

                    Swal.fire(
                        'Hata!',
                        ''+value+'',
                        'warning'
                    )

                });

            }


        },


    });

}

function core_onclick(route,id,msg, redirect = null){

    var	status  =   null;
    var csrf    =   $('input[name=_token]').val();


    if(route == "" || id == "" || msg == ""){

        Swal.fire({
            title: 'Hata',
            html: 'Eksik ya da hatalı parametre gönderiyorsunuz. Lütfen geçerli bir işlem sağlayınız.',
            icon: 'warning',
            allowEscapeKey : false,
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Kapat',
        });

        return false;

    }

    Swal.fire({
        title: 'Bilgi',
        html: msg,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Onayla',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.value) {

            $.ajax({

                type:'POST',
                url:route,
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                cache: false,
                data:{'id' : id},
                dataType: "json",
                success:function(data){

                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı',
                        text: data.msg,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Tamam',
                    }).then((result) => {
                        if (result.value) {

                            location.reload();

                        }

                    });

                },
                error: function (data) {

                    $.each(data.responseJSON.errors, function(key,value) {

                        Swal.fire(
                            'Hata!',
                            ''+value+'',
                            'warning'
                        )

                    });



                },


            });

        }else{

            return false;

        }
    });


}

function login_core_form(route){

    var	params		=	$('form').serialize();
    var	query		=	$('form').serializeArray();
    obj             =   {};

    $(query).each(function(i, field){
        obj[field.name] = field.value;
    });

    $.ajax({

        type:'POST',
        url:route,
        data:params,
        dataType: "json",
        beforeSend:function(data){

            $('.fa-spin').show();

        },
        success:function(data){

            $('.fa-spin').hide();
            location.reload();

        },
        error: function (xhr) {

            $('.fa-spin').hide();
            $('#_validation').html('');
            $.each(xhr.responseJSON.errors, function(key,value) {
                $('#_validation').html('<div class="alert alert_danger">Geçerli bir e-mail ve şifre giriniz.</div');
            });


        },


    });

}
