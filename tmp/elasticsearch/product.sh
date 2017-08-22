# 创建医院基本信息库
# product
curl -XPOST "http://192.168.33.10:9200/medical/product/_mapping?pretty" -d '
	"product" : {
		"_all" : {
			# 指定中文分词器
			"indexAnalyzer": "ik",
            "searchAnalyzer": "ik",
            "store": "false"
		},
		"properties" : {
			"title" : {
				"type" : "string",
			}
		} 
	}
'