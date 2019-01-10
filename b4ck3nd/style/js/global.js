var path = 'berlian/';
var url = location.protocol + '//' + location.host + '/' + path;

function responsive_filemanager_callback(field_id){
    $preview = $('#' + field_id).data('preview');
    $('#' + $preview).attr('src',url + 'media/upload/' + $('#' + field_id).val());
}

$(document).ready(function(){

	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})

    // DATATABLES
    $('#datatables').dataTable({
        'oLanguage': {
            'sLengthMenu': '_MENU_',
            'sSearch': '_INPUT_',
        },
        "tableTools": {
            "sSwfPath": url + "b4ck3nd/style/js/datatables/swf/copy_csv_xls_pdf.swf"
        }
    });

    //--
    $(window).resize(function() {
    	var	$contentHeight	=	$(window).outerHeight() - $(".navbar").outerHeight();
    	if( $(".main-content").outerHeight() <= $contentHeight ){
    		$(".main-content").height( $contentHeight );
    	}
    	
    });
    $(window).trigger('resize');

    $(".fancy-iframe").fancybox({
        width     : 900,
        minHeight    : 600,
        type      : 'iframe',
        autoDimensions: false,
        autoSize     : false
    });

    $('.datetimepicker').datetimepicker();

    tinymce.init({
        selector: '.texteditor',
        theme: 'modern',
        height: 300,
        plugins: [
            'code advlist autolink lists link image charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking table contextmenu directionality',
            'emoticons paste textcolor colorpicker textpattern responsivefilemanager'
        ],
        toolbar1: 'code | styleselect | formatselect | fontselect | fontsizeselect | table | forecolor backcolor | spellchecker',
        toolbar2: 'undo redo | cut copy paste print | bold italic underline strikethrough | charmap | subscript superscript | blockquote hr anchor pagebreak',
        toolbar3: ' | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink | responsivefilemanager image media | search replace code visualblocks preview fullscreen',
        image_advtab: true,
        relative_urls: false,
        menubar: false,
        paste_auto_cleanup_on_paste : true,
        paste_preprocess : function(pl, o) {
            // Content string containing the HTML from the clipboard
            //alert(o.content);
            o.content = o.content;
        },
        paste_postprocess : function(pl, o) {
            // Content DOM node containing the DOM structure of the clipboard
            //alert(o.node.innerHTML);
            o.node.innerHTML = o.node.innerHTML.replace(/&nbsp;/ig, " ");
        },
        external_filemanager_path: url + 'b4ck3nd/style/js/filemanager/',
        filemanager_title: 'File Manager',
        external_plugins: { 'filemanager' : url + 'b4ck3nd/style/js/filemanager/plugin.js'}
    });

    $( ".sortable" ).sortable({
        items: "> li",
        containment: "parent"
    });
    $( "#sortable" ).disableSelection();

    $("#nav-type").on("change", function(){
        if($(this).val() == "direct"){
            $(".direct-option").show();
            $(".page-option").hide();
            $(".category-option").hide();
            $(".media-option").hide();
        }
        if($(this).val() == "page"){
            $(".direct-option").hide();
            $(".page-option").show();
            $(".category-option").hide();
            $(".media-option").hide();
        }
        if($(this).val() == "category"){
            $(".direct-option").hide();
            $(".page-option").hide();
            $(".category-option").show();
            $(".media-option").hide();
        }
        if($(this).val() == "media"){
            $(".direct-option").hide();
            $(".page-option").hide();
            $(".category-option").hide();
            $(".media-option").show();
        }
    });

    $("#nav-type").change();

    $("#template-option").on("change", function(){
        if($(this).val() == "default" || $(this).val() == "registration"){
            $(".video-option").hide();
            $(".gallery-option").hide();
            $(".youtube-option").hide();
            $(".document-option").hide();
        }
        if($(this).val() == "video"){
            $(".video-option").show();
            $(".gallery-option").hide();
            $(".youtube-option").hide();
            $(".document-option").hide();
        }
        if($(this).val() == "gallery"){
            $(".video-option").hide();
            $(".gallery-option").show();
            $(".youtube-option").hide();
            $(".document-option").hide();
        }
        if($(this).val() == "youtube"){
            $(".video-option").hide();
            $(".gallery-option").hide();
            $(".youtube-option").show();
            $(".document-option").hide();
        }
        if($(this).val() == "document"){
            $(".video-option").hide();
            $(".gallery-option").hide();
            $(".youtube-option").hide();
            $(".document-option").show();
        }
    });
    $("#template-option").change();

    $('.selectfind').select2({
      theme: "bootstrap"
    });

    
    $('.datepicker').datepicker({
        todayHighlight: true
    });

    
    $('.birthdatepicker').datepicker({
        autoclose : true,
        format: "dd-mm-yyyy",
        defaultViewDate: {year:1995, month:0, day:1},
    });

    $('.edit_phone .edit').on("click", function(){
        $(this).parent().find(".edit").toggleClass("hidden");
        $(this).parent().find("form").toggleClass("hidden");
        $(this).parent().find(".display_telp").toggleClass("hidden");
    })

    $tagsPlaceholder = $("#input-tags").data("placeholder");

    $("#input-tags").tagsInput({
       'autocomplete_url': url + "b4ck3nd/tags.php",
        'autocomplete':{selectFirst:true,width:'100px',autoFill:true},
       'height':'78px',
       'width':'100%',
       'interactive':true,
       'defaultText': $tagsPlaceholder,
       'removeWithBackspace' : true,
       'placeholderColor' : '#666666'
    });

    $( "#hashtag" ).autocomplete({
      source: hashtagSource
    });
})