
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<title>公交详细信息</title>
	<style type="text/css">
		body, html{width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
		#l-map{height:300px;width:100%;}
		#r-result {width:100%;}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5N9KN5HEaVWWzRu8T1T6spFRhfsjvUMu"></script>
	<title>公交/地铁线路查询</title>
</head>
<body>
	<div id="l-map"></div>
	<div id="r-result"></div>
</body>
</html>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("l-map");            // 创建Map实例
	map.centerAndZoom(new BMap.Point(119.45, 32.78), 12);

	var busline = new BMap.BusLineSearch(map,{
		renderOptions:{map:map,panel:"r-result"},
			onGetBusListComplete: function(result){
			   if(result) {
				 var fstLine = result.getBusListItem(0);//获取第一个公交列表显示到map上
				 busline.getBusLine(fstLine);
			   }
			}
	});
	function busSearch(){
		var busName = "<?php echo $_GET["name"]; ?>";
		busline.getBusList(busName);
	}
	setTimeout(function(){
		busSearch();
	},1500);
</script>
