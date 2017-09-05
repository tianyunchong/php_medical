# 索引创建别名
curl -XPUT 'http://192.168.33.10:9200/medical/_alias/medical_alias'
# 创建新的索引
curl -XPUT 'http://192.168.33.10:9200/medical_v1/'
# 创建mapping映射
curl -XPOST "http://192.168.33.10:9200/medical_v1/products/_mapping" -d '
{
	"products" : {
		"properties" : {
			"title": {"type" : "text", "analyzer" : "ik_max_word"}
		} 
	}
}
'
# 更新alias映射
curl -XPOST 'http://192.168.33.10:9200/_aliases' -d '
{
	"actions" : [
	{
		"remove" : {
			"alias" : "medical_alias",
			"index" : "medical"
		}
	},
	{
		"add" : {
			"alias" : "medical_alias",
			"index" : "medical_v1"
		}
	}
	]
}
'
