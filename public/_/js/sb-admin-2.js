$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
});

$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }
        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    })
})

$(document).ready(function(){
    var a = document.title;
    $("#"+a).addClass('active');
    if($("#"+a).parent().parent().hasClass('nav-second-level')){
        $("#"+a).parent().parent().addClass('in');
        $("#"+a).parent().parent().parent().addClass('active');
    }
    if($("#"+a).parent().parent().hasClass('nav-third-level')){
        $("#"+a).parent().parent().addClass('in');
        $("#"+a).parent().parent().parent().addClass('active');
        $("#"+a).parent().parent().parent().parent().addClass('in');
        $("#"+a).parent().parent().parent().parent().parent().addClass('active');
    }
// category activation
$('#deactivate').click(function(){
    deactivate('#activeStatus','#inactiveStatus');
    $('.activeCat').removeAttr('id');
    $('.inactiveCat').attr('id','status');
});
$('#activate').click(function(){
    activate('#inactiveStatus','#activeStatus');
    $('.inactiveCat').removeAttr('id');
    $('.activeCat').attr('id','status');
});
// save category
$('#categoryBtn').click(function(){
    if($('#catID').val()=='Add'){
        addCategory();
    }else{
    var status=$('#status').val();
    var type=$(this).val();
    var table = $('#'+type).DataTable();
    var name=$('#name').val();
    var desc=$('#description').val();
    var id=$('#catID').val();
    var idx =table.row( '#'+type+id).index();
    if(status==1){
        var status2='Active';
    }else{status2='Inactive';}
    $.post('/editCategory',{id:id,type:type,status:status,name:name,desc:desc},function(data){
        $('#myModal').modal('hide');
        table.cell( idx, 0 ).data( name ).draw();
        table.cell( idx, 1 ).data( status2 ).draw();
    });
    }
});
//set active user on click
$('#userlist tr').click(function(){
    $("#userlist").each(function(){
        $("tr").removeClass("active");
        });
    $(this).addClass('active');
});
//roles activation buttons
$('#activateAdmin').click(function(){
    activateAdmin();
});
$('#deactivateAdmin').click(function(){
    deactivateAdmin();
});
$('#activateOwner').click(function(){
    activateOwner();
});
$('#deactivateOwner').click(function(){
    deactivateOwner();
});
// save edited role
$('#roleBtn').click(function(){
    var admin=$('#AdminStatus').val();
    var owner=$('#OwnerStatus').val();
    var id=$('#userID').val();
    var table = $('#userlist').DataTable();
    var idx =table.row('#user'+id).index();
    if(admin==1&&owner==1){var roles='admin, member, owner';}
    else if(admin==1&&owner==0){var roles='admin, member';}
    else if(admin==0&&owner==0){var roles='member';}
    else if(admin==0&&owner==1){var roles='member, owner';}
     $.post('/editroles',{id:id,admin:admin,owner:owner},function(data){
        $('#roleModal').modal('hide');
        table.cell(idx,5).data(roles+' <button class="btn btn-info btn-xs"onclick="editRole('+id+');">Edit</button>').draw();
     });
});
//user deactivation button
$('#deactivateUserBtn').click(function(){
    var id=$('#user_id').val();
    var table = $('#userlist').DataTable();
    $.post('/deactivateUser',{id:id},function(data){
         $('#userActivationModal').modal('hide');
         table.row('#user'+id).remove()
        .draw();
    });
});
});//end of ready function
//add category
function addCategory(){
    var type=$('#categoryBtn').val();
    var name=$('#name').val();
    var desc=$('#description').val();
    var table=  $('#'+type).dataTable(); 
    var catNO = $('#catNo').val();
    $.post('/addCategory',{type:type,name:name,desc:desc,catNO:catNO},function(data){
        $('#myModal').modal('hide');
        var rowIndex= table.fnAddData([
                name,'Active','<button class="btn btn-primary btn-xs" onclick="category('+data['id']+', '+"'"+type+"'"+');">Edit</button>'
            ]);
           var row = table.fnGetNodes(rowIndex);
            $(row).attr( 'id', type+data['id'] );
            if(type=='category'){
            $(row).attr( 'onclick', "subcategory("+data['id']+")" );}
    });
}
//subcategory fetch
function subcategory(id){
    $('#catNo').enable();
    $('#catNo').val(id);
     $.post('/getSubCategory',{val: id},function(data){
       $('#subcategory').dataTable().fnClearTable();
       $('#subcategory').dataTable().fnDestroy();
        $("#category").each(function(){
             $("tr").removeClass("active");
        });
       $('#category'+id).addClass('active');
       var table=  $('#subcategory').dataTable(); 
       $.each(data, function(key, value) { 
        if(value['status']==1){
            status= 'Active';
        }else{ status='Inactive';}
          var rowIndex= table.fnAddData([
                value['name'],status,'<button class="btn btn-primary btn-xs" onclick="category('+value['id']+', '+"'subcategory'"+');">Edit</button>'
            ]);
           var row = table.fnGetNodes(rowIndex);
            $(row).attr( 'id', 'subcategory'+value['id'] );
      });
     });
}
//category modal fetch
function category(id,type){
    var table = $('#'+type).DataTable();
    if(type=='category'){
        var name='categoryName';
    }else{var name='name';}
    $('#statusGroup').removeClass('hidden');
    $('.modal-title').text('Edit '+type);
    $('#myModal').modal('show');
    $.post('/getdetails',{val: id,type:type},function(data){
        $('#name').val(data[0][name]);
        $('#description').val(data[0]['description']);
        if(data[0]['status']==1){
            activate('#inactiveStatus','#activeStatus');
            $('.activeCat').attr('id','status');
        }else{
            deactivate('#activeStatus','#inactiveStatus');
            $('.inactiveCat').attr('id','status');
        }
        $('.cat-btn').attr('id','categoryBtn');
        $('#categoryBtn').val(type);
        $('#catID').val(id);
    });
}
//category activation functions
function activate(add,remove){
    $(add).addClass('hidden');
    $(remove).removeClass('hidden');
}
function deactivate(add,remove){
    $(add).addClass('hidden');
    $(remove).removeClass('hidden');
}
function addcategory(type){
    $('#statusGroup').addClass('hidden');
    $('#myModal').modal('show');
    $('.modal-title').text('Add '+type);
    $('#name').val('');
    $('#description').val('');
    $('#catID').val('Add');
    $('#categoryBtn').val(type);
}
//role Admin Activation
function deactivateAdmin(){
    deactivate('#activeAdmin','#inactiveAdmin');
    $('.activeAdmin').removeAttr('id');
    $('.inactiveAdmin').attr('id','AdminStatus');
}
function activateAdmin(){
    activate('#inactiveAdmin','#activeAdmin');
    $('.inactiveAdmin').removeAttr('id');
    $('.activeAdmin').attr('id','AdminStatus');
}
//role Owner Activation
function deactivateOwner(){
    deactivate('#activeOwner','#inactiveOwner');
    $('.activeOwner').removeAttr('id');
    $('.inactiveOwner').attr('id','OwnerStatus');
}
function activateOwner(){
    activate('#inactiveOwner','#activeOwner');
    $('.inactiveOwner').removeAttr('id');
    $('.activeOwner').attr('id','OwnerStatus');
}
function editRole(id){
  deactivateAdmin();
  deactivateOwner();
  $('#userID').val(id);
    $.post('/getroles',{id:id},function(data){
        $.each(data, function(key, value) 
            { 
            if(value['role_id']==2){
              activateAdmin();
            }else if(value['role_id']==3)
            { activateOwner();}
      });
    });
    $('#roleModal').modal('show');
}
//user deactivation function
function deactivateUser(id){
    $('#userActivationModal').modal('show');
    $('#user_id').val(id);
}
//activate a user function
function activateUser(id){
    $.post('/activateUser',{id:id},function(data){
        $('#userlist').DataTable().row('#user'+id).remove()
        .draw();
    });
}

