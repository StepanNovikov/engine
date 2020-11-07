function post_query(url, name, data){'gform','register','email.password.captcha'

    let str = "";

    $.each(data.split('.'),function(key,val){
        str+='&' + val + '=' + $('#'+val).val();
    });

    $.ajax({
        url: '/engine/' + url,
        type: 'POST',
        data: name + '_f=1' + str,
        cache: false,
        success: function(result){
            obj = jQuery.parseJSON(result);
            if(obj.go) {
                go(obj.go);
            } else {
                alert(obj.message);
            }
        }
    })
}


function go(url){
    window.location.href = '/engine/' + url;
}