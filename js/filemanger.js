var $tf,$thisdir;
function getFolder(path){
    $($tf).html('');
    $.ajax({
        type: "POST",
        url: "<?php echo(url('ajax/admin.filemanager.getdir')); ?>",
        data: {dir:path},
        dataType:'json',
        success: function(data){
            analizJson(data);
            inintializ();
            buttons();
        }
    });
}
function analizJson(Json){
    JsonFiles = Json.files;
    for(x=0;x!=JsonFiles.length;x++){
        var file = JsonFiles[x];
        var runcomand = file.type == 'dir' ? 'Open(this);' : 'Download(this);';
        
        var innerCode  = "<tr>\
                            <td class=\"name\" width=\"40%\"><a href=\""+file.adress+"\" onclick=\"return "+runcomand+";\">"+file.filename+"</a></td>\
                            <td class=\"size\">"+file.size+"</td>\
                            <td class=\"lastchange\">"+file.lastchange+"</td>\
                            <td class=\"mime\">"+file.mime+"</td>\
                            <td class=\"permission\">"+file.permission+"</td>\
                        </tr>";
        $($tf).append(innerCode);
        //alert('salam');
    }
    $thisdir = Json.thisdir;
}
function Open(elem){
    getFolder($(elem).attr('href'));
    return false;
}
function Download(elem){
    window.location.href = '<?php echo(url("ajax/admin.filemanager.download")); ?>?path='+$(elem).attr('href');
    return false;
}
$(document).ready(function(){
    $tf = $('#tbodyfilemaneger');
    setTimeout("getFolder('');", 2000);
    $newfilebtn = $('#newfilebtn');
    $newdirbtn = $('#newdirbtn');
    $editbtn = $('#editbtn');
    $delbtn = $('#delbtn');
    $downbtn = $('#downbtn');
    $zipbtn = $('#zipbtn');
    $unzipbtn = $('#unzipbtn');
    $copybtn = $('#copybtn');
    $movebtn = $('#movebtn');
    $upbtn = $('#upbtn');
    $renamebtn = $('#renamebtn');
    $upbtn.click(function(){
        if(!$(this).attr('disabled')){
            $( "#upload_filemanager" ).dialog( "open" );
        }
    });
    
    $delbtn.click(function(){
        if(!$(this).attr('disabled')){
            var co = window.confirm('آیا شما مطمئنید؟');
            if(co != true){$('tr.selected', $tf).removeClass('selected');return false;}
            var files ="";
            var $selected = $('tr.selected', $tf);
            for(x=0;x!=$selected.length;x++){
                if(files!= '')files += '|';
                files += $('a', $selected[x]).attr('href');
            }
            $.ajax({
                type: "POST",
                url: "<?php echo(url('ajax/admin.filemanager.delete')); ?>",
                data: {files:files},
                success: function(data){
                    switch(data){
                        case('ok'):getFolder($thisdir);break;
                    }
                }
            });
        }
    });
    $('#editgrid').slideUp(0);
    $editbtn.click(function(){
        if(!$(this).attr('disabled')){
            var file = $('tr.selected', $tf)[0];
            file = $('a', file).attr('href');
            $('#maingrid').slideUp(1000);
            $('#editgrid').slideDown(1000);
            $.ajax({
                type: "POST",
                url: "<?php echo(url('ajax/admin.filemanager.getsource')); ?>",
                data: {file:file},
                dataType:'text',
                success: function(data){
                    $('#editgrid textarea').val(data);
                }
            });
        }
    });
    $('#canceleditbtn').click(function(){
        $('#maingrid').slideDown(1000);
        $('#editgrid').slideUp(1000);
        $('#editgrid textarea').val('');
    });
    $('#saveditbtn').click(function(){
        var file = $('tr.selected', $tf)[0];
        file = $('a', file).attr('href');
        $.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.filemanager.putsource')); ?>",
            data: {file:file, source:$('#editgrid textarea').val()},
            dataType:'text',
            success: function(data){
                if(data == 'ok'){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo(url('ajax/admin.filemanager.getsource')); ?>",
                        data: {file:file},
                        dataType:'text',
                        success: function(data){
                            $('#editgrid textarea').val(data);
                        }
                    });
                    alert('با موفقیت ذخیره شد');
                }
            }
        });
    });
    $( "#upload_filemanager" ).dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
	}).find('button.submit').click(function(){
		var $el = $(this).parents('.ui-dialog-content');
	   $.ajaxFileUpload({
            url:'<?php echo(url('ajax/admin.filemanager.upload')); ?>',
            secureuri:false,
            fileElementId:'file_filemanager',
            data:{dir:$thisdir},
            dataType: 'text',
            success: function (data, status){
                switch(data){
                    case('ok'):getFolder($thisdir);$el.find('form')[0].reset();$el.dialog('close');break;
                    case('security'):$.jGrowl('سرور در فایل شما مورد امنیتی پیدا کرد و فایل شما از سرور حذف گردید.', { header: 'خطا' });break;
                }
            },
            error: function (data, status, e)
            {
                alert(data);
            },
            done:function(){
                $el.dialog('close');
            }
        });
			
	}).end().find('button.cancel').click(function(){
		var $el = $(this).parents('.ui-dialog-content');
		$el.find('form')[0].reset();
		$el.dialog('close');
	});
    $( "#newfile_filemanager" ).dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
	}).find('button.submit').click(function(){
		var $el = $(this).parents('.ui-dialog-content');
		$.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.filemanager.newfile')); ?>",
            data: {file:$('#newfilename_filemanager').val(),dir:$thisdir},
            dataType:'text',
            success: function(data){
                switch(data){
                    case('ok'):$el.find('form')[0].reset();$el.dialog('close');getFolder($thisdir);$.jGrowl('ساخته شد', { header: 'موفقیت آمیز' });break;
                    case('repeat'):$.jGrowl('این فایل وجود دارد', { header: 'خطا' });break;
                    default:$.jGrowl(data, { header: 'پیام سرور:' });break;
                }
            }
        });
	}).end().find('button.cancel').click(function(){
		var $el = $(this).parents('.ui-dialog-content');
		$el.find('form')[0].reset();
		$el.dialog('close');
	});
    $newfilebtn.click(function(){
        $( "#newfile_filemanager" ).dialog("open");
    });
    
    
    $( "#newdir_filemanager" ).dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
	}).find('button.submit').click(function(){
		var $el = $(this).parents('.ui-dialog-content');
		$.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.filemanager.newdir')); ?>",
            data: {name:$('#newdirname_filemanager').val(),dir:$thisdir},
            dataType:'text',
            success: function(data){
                switch(data){
                    case('ok'):$el.find('form')[0].reset();$el.dialog('close');getFolder($thisdir);$.jGrowl('ساخته شد', { header: 'موفقیت آمیز' });break;
                    case('repeat'):$.jGrowl('این پوشه قبلا ساخته شده!', { header: 'خطا' });break;
                    default:$.jGrowl(data, { header: 'پیام سرور:' });break;
                }
            }
        });
	}).end().find('button.cancel').click(function(){
		var $el = $(this).parents('.ui-dialog-content');
		$el.find('form')[0].reset();
		$el.dialog('close');
	});
    $newdirbtn.click(function(){
        $( "#newdir_filemanager" ).dialog("open");
    });
    
    
    
    $( "#zip_filemanager" ).dialog({
		autoOpen: false,
		modal: true,
		width: 400,
		open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
	}).find('button.submit').click(function(){
		var $el = $(this).parents('.ui-dialog-content');
        
        var files = "";
        var $selected = $('tr.selected', $tf);
        for(x=0;x!=$selected.length;x++){
            if(files!= '')files += '|';
            files += $('a', $selected[x]).attr('href');
        }
		$.ajax({
            type: "POST",
            url: "<?php echo(url('ajax/admin.filemanager.zip')); ?>",
            data: {name:$('#zipname_filemanager').val(),files:files, dir:$thisdir},
            dataType:'text',
            success: function(data){
                switch(data){
                    case('ok'):$el.find('form')[0].reset();$el.dialog('close');getFolder($thisdir);$.jGrowl('ساخته شد', { header: 'موفقیت آمیز' });break;
                    case('repeat'):$.jGrowl('این پوشه قبلا ساخته شده!', { header: 'خطا' });break;
                    default:$.jGrowl(data, { header: 'پیام سرور:' });break;
                }
            }
        });
	}).end().find('button.cancel').click(function(){
		var $el = $(this).parents('.ui-dialog-content');
		$el.find('form')[0].reset();
		$el.dialog('close');
	});
    $zipbtn.click(function(){
        $( "#zip_filemanager" ).dialog("open");
    });
});
function inintializ(){
    $('tr', $tf).click(function(){
        if($('a', this).attr('href').length > $thisdir.length){
            if($(this).hasClass('selected'))$(this).removeClass('selected');else $(this).addClass('selected');
        }
        
        buttons();
    });
    $('tr', $tf).dblclick(function(){
        var a = $(this).attr('onclick');
        a();
    });
}

var $newfilebtn,$newdirbtn,$editbtn,$delbtn,$downbtn,$zipbtn,$unzipbtn,$copybtn,$movebtn,$upbtn,$renamebtn;
function buttons(){
    var $selected = $('.selected', $tf);
    if($selected.length == 0){
        $newfilebtn.attr('disabled', false);
        $newdirbtn.attr('disabled', false);
        $delbtn.attr('disabled', true);
        $editbtn.attr('disabled', true);
        $downbtn.attr('disabled', true);
        $zipbtn.attr('disabled', true);
        $unzipbtn.attr('disabled', true);
        $copybtn.attr('disabled', true);
        $movebtn.attr('disabled', true);
        $upbtn.attr('disabled', false);
        $renamebtn.attr('disabled', true);
    }else if($selected.length == 1){
        $newfilebtn.attr('disabled', true);
        $newdirbtn.attr('disabled', true);
        $delbtn.attr('disabled', false);
        var $mime = $('.mime', $selected).text();
        if(($mime.match(/text/) || $mime.match(/inode/) ) && !$mime.match(/php/)){
            $editbtn.attr('disabled', false);
        }else{
            $editbtn.attr('disabled', true);
        }
        if(!$('.mime', $selected).text().match(/directory/)){
            $downbtn.attr('disabled', false);
        }else{
            $downbtn.attr('disabled', true);
        }
        $zipbtn.attr('disabled', false);
        if(getext($('.name', $selected).text()) == 'zip'){
            $unzipbtn.attr('disabled', false);
        }else{
            $unzipbtn.attr('disabled', true);
        }
        $copybtn.attr('disabled', false);
        $movebtn.attr('disabled', false);
        $upbtn.attr('disabled', true);
        $renamebtn.attr('disabled', false);
    }else{
        $newfilebtn.attr('disabled', true);
        $newdirbtn.attr('disabled', true);
        $delbtn.attr('disabled', false);
        $editbtn.attr('disabled', true);
        $downbtn.attr('disabled', true);
        $zipbtn.attr('disabled', false);
        $unzipbtn.attr('disabled', true);
        $copybtn.attr('disabled', false);
        $movebtn.attr('disabled', false);
        $upbtn.attr('disabled', true);
        $renamebtn.attr('disabled', true);
    }
}
function getext(name){
    name = name.split('.');
    if(name.length == 1)return '';
    else return name[name.length-1];
}