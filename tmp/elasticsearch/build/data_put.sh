# 数据创建新增
## 创建，存在则新增
curl -XPUT 'http://192.168.33.10:9200/medical/products/1' -d '{
	"title" : "aaa",
	"address" : "bbbb"
}'
## 创建，存在则新增, _id自动生成
curl -XPOST 'http://192.168.33.10:9200/medical/products/' -d '{
	"title" : "aaa",
	"address" : "bbbb"	
}'
## 创建，存在则跳过
curl -XPUT 'http://192.168.33.10:9200/medical/products/1?op_type=create' -d '{
	
}'