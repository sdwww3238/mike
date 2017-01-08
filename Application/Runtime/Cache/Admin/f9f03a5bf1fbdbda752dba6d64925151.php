<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="javascript:;" class="add">添加</a>
    <a href="javascript:;" class="del">删除</a>
    <a href="javascript:;" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="num">序号</th>
                <th class="name">部门</th>
                <th class="process">所属部门</th>
                <th class="node">排序</th>
                <th class="time">备注</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        	<tr>
            	<td class="num">1</td>
                <td class="name">总裁办</td>
                <td class="process">顶级部门</td>
                <td class="node">1</td>
                <td class="time">无</td>
                <td class="operate"><a href="javascript:;">查看</a></td>
            </tr>
            <tr>
                <td class="num">1</td>
                <td class="name">总裁办</td>
                <td class="process">顶级部门</td>
                <td class="node">1</td>
                <td class="time">无</td>
                <td class="operate"><a href="javascript:;">查看</a></td>
            </tr>
            <tr>
                <td class="num">1</td>
                <td class="name">总裁办</td>
                <td class="process">顶级部门</td>
                <td class="node">1</td>
                <td class="time">无</td>
                <td class="operate"><a href="javascript:;">查看</a></td>
            </tr>
            <tr>
                <td class="num">1</td>
                <td class="name">总裁办</td>
                <td class="process">顶级部门</td>
                <td class="node">1</td>
                <td class="time">无</td>
                <td class="operate"><a href="javascript:;">查看</a></td>
            </tr>
            <tr>
                <td class="num">1</td>
                <td class="name">总裁办</td>
                <td class="process">顶级部门</td>
                <td class="node">1</td>
                <td class="time">无</td>
                <td class="operate"><a href="javascript:;">查看</a></td>
            </tr>
            <tr>
                <td class="num">1</td>
                <td class="name">总裁办</td>
                <td class="process">顶级部门</td>
                <td class="node">1</td>
                <td class="time">无</td>
                <td class="operate"><a href="javascript:;">查看</a></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="pagination ue-clear"></div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">
$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})

$('.pagination').pagination(100,{
	callback: function(page){
		alert(page);	
	},
	display_msg: true,
	setPageNo: true
});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');
</script>
</html>