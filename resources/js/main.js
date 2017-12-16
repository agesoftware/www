function retrievePermissions() {
    var host = window.location.host;
    var url = 'http://'+host+'/back/br.com.age.controller/PermissionController/retrieve.php';
    var data = {login:'Administrador', password:'admin'};
    var dataType = "json";

    $.post(url, data, function(response) {
        var permissions = response.permission_list;
        if(permissions != null && permissions.length > 0) {
            $('#resposta').html('');
            permissions.forEach(function(permission) {
                var perm = '<div class="permission">'+
                           '    <p class="perm-id">'+permission.id+'</p>'+
                           '    <p class="perm-desc">'+permission.description+'</p>'+
                           '    <p class="perm-rules">'+permission.rules+'</p>'+
                           '</div>'

                $('#resposta').append(perm);
            });
        }
        else {
            var mensagem = response;
            if(mensagem.status == 'Error') {
                alert(mensagem.message);
            }
        }
    }, dataType);
}