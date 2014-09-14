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
    deactivate();
    $('.activeCat').removeAttr('id');
    $('.inactiveCat').attr('id','status');
});
$('#activate').click(function(){
    activate();
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
                name,'Active','<button class="btn btn-primary btn-xs" onclick="category('+data['id']+', '+"'category'"+');">Edit</button>'
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
            activate();
            $('.activeCat').attr('id','status');
        }else{
            deactivate();
            $('.inactiveCat').attr('id','status');
        }
        $('.cat-btn').attr('id','categoryBtn');
        $('#categoryBtn').val(type);
        $('#catID').val(id);
    });
}
//category activation functions
function activate(){
    $('#inactiveStatus').addClass('hidden');
    $('#activeStatus').removeClass('hidden');
}
function deactivate(){
    $('#activeStatus').addClass('hidden');
    $('#inactiveStatus').removeClass('hidden');
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



// $(function () {

//     function revert() {
//         $(".userlist .editfield").each(function () {
//             var $td = $(this).closest('td');
//             $td.empty();
//             $td.text($td.data('oldText'));
//             $td.data('editing', false);

//             // canceled            
//             console.log('Edit canceled.');
//         });
//     }

//     function save($input) {
//         var val = $input.val();
//         var $td = $input.closest('td');
//         $td.empty();
//         $td.text(val);
//         $td.data('editing', false);

//         // send json or whatever
//         console.log('Value changed');
//     }


//     $('.userlist td').on('keyup', 'input.editfield', function (e) {
//         if (e.which == 13) {
//             // save
//             $input = $(e.target);
//             save($input);
//         } else if (e.which == 27) {
//             // revert
//             revert();
//         }
//     });

//     $(".userlist td").dblclick(function (e) {

//         // consuem event
//         e.preventDefault();
//         e.stopImmediatePropagation();

//         $td = $(this);

//         // if already editing, do nothing.
//         if ($td.data('editing')) return;
//         // mark as editing
//         $td.data('editing', true);

//         // get old text
//         var txt = $td.text();

//         // store old text
//         $td.data('oldText', txt);

//         // make input
//         var $input = $('<input type="text" class="editfield">');
//         $input.val(txt);

//         // clean td and add the input
//         $td.empty();
//         $td.append($input);
//     });


//     $(document).click(function (e) {
//         revert();
//     });
// });

// $(".userlist td").click(function (e){
//     $(this).parent().addClass('active';)
// });