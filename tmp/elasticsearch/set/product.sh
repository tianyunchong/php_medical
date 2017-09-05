# 创建医院基本信息库
# 删除已经存在的索引
curl -XDELETE 'http://192.168.33.10:9200/medical/'
# 创建索引
curl -XPUT 'http://192.168.33.10:9200/medical/'
# 创建索引别名
curl -XPUT 'http://192.168.33.10:9200/medical/_alias/medical_alias'
# 创建类型products, 创建mapping映射
# title  医院的名称标题
# address 医院的地址
# lon, lat 经纬度
curl -XPOST "http://192.168.33.10:9200/medical/products/_mapping?update_all_types" -d '
{
	"products" : {
		"properties" : {
			"title": {"type" : "string", "analyzer" : "ik_max_word"},
			"address" : {"type" : "string", "index": "not_analyzed"}, 
			"lon" : {"type" : "float"},
			"lat" : {"type" : "float"},
			"telephone" : {"type" : "keyword"}
		} 
	}
}
'