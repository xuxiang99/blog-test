$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

window.onload = function() {
	$(".like-button").click(function (event) {
	    // alert('zzz');
	    var target = $(event.target);
	    var current_like = target.attr("like-value");
	    var user_id = target.attr("like-user");
	    if (current_like == 1) {
	        //current_like == 1,则取消关注
	        $.ajax({
	            url:"/user/"+user_id+"/unfan",
	            method:"POST",
	            dataType:"JSON",
	            success:function (data) {
	                if (data.error != 0) {
	                    alert(data.message);
	                    return ;
	                }
	                target.attr("like-value", 0);
	                target.text("关注");
	                target.addClass('btn-primary');
	            }
	        })
	    } else {
	        //增加关注
	        $.ajax({
	            url:"/user/"+user_id+"/fan",
	            method:"POST",
	            dataType:"JSON",
	            success:function (data) {
	                if (data.error != 0) {
	                    alert(data.message);
	                    return ;
	                }
	                target.attr("like-value", 1);
	                target.text("取消关注");
	                target.removeClass('btn-primary');
	            }
	        })
	    }
	});

	var editor = new wangEditor('content');

	editor.config.uploadImgFileName = 'image'

	editor.config.uploadImgUrl = '/article/image/upload';

	// 设置 headers（举例）
	editor.config.uploadHeaders = {
	    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	};

	editor.config.uploadImgFns.onload = function (resultText, xhr) {
        // resultText 服务器端返回的text
        // xhr 是 xmlHttpRequest 对象，IE8、9中不支持
        console.log(resultText)
        // console.log(resultText)
        // 上传图片时，已经将图片的名字存在 editor.uploadImgOriginalName
        var originalName = editor.uploadImgOriginalName || '';  
        
        // 如果 resultText 是图片的url地址，可以这样插入图片：
        editor.command(null, 'insertHtml', '<img src="' + resultText + '" alt="' + originalName + '" style="max-width:50%;"/>');
        // 如果不想要 img 的 max-width 样式，也可以这样插入：
        // editor.command(null, 'InsertImage', resultText);
    };

	editor.create();


	// WangEditor3操作
	
	// var E = window.wangEditor
	// var editor = new E('#text') // 两个参数也可以传入 elem 对象，class 选择器
	// var $content = $('#content')
	// //开启debug模式
	// editor.customConfig.debug = true;
	// // 关闭粘贴内容中的样式
	// editor.customConfig.pasteFilterStyle = false
	// // 忽略粘贴内容中的图片
	// editor.customConfig.pasteIgnoreImg = true
	// // 使用 base64 保存图片
	// //editor.customConfig.uploadImgShowBase64 = true

	// // 上传图片到服务器
	// editor.customConfig.uploadFileName = 'image'; //设置文件上传的参数名称
	// editor.customConfig.uploadImgServer = '/article/image/upload'; //设置上传文件的服务器路径
	// editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024; // 将图片大小限制为 3M
	// editor.customConfig.uploadImgHeaders = {
	//     'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	// }
	// //自定义上传图片事件
	// editor.customConfig.uploadImgHooks = {
	//     before: function(xhr, editor, files) {

	//     },
	//     success: function(xhr, editor, result) {
	//         console.log("上传成功"+ result);
	//     },
	//     fail: function(xhr, editor, result) {
	//         console.log("上传失败,原因是" + result);
	//     },
	//     error: function(xhr, editor) {
	//         console.log("上传出错");
	//     },
	//     timeout: function(xhr, editor) {
	//         console.log("上传超时");
	//     },
	//     customInsert: function (insertImg, result, editor) {
	//         // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
	//         // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果

	//         // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
	//         var url = result.url;
	//         insertImg(url)

	//         // result 必须是一个 JSON 格式字符串！！！否则报错
	//     }
	// }
	// editor.customConfig.onchange = function (html) {
 //            // 监控变化，同步更新到 textarea
 //            $content.val(html)
 //        }
	// editor.create()
	// // 初始化 textarea 的值
 //    $content.val(editor.txt.html(''))
}