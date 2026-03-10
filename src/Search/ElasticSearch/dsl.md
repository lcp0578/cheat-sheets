## DSL 查询语法
> DSL：Domain Specified Language 特定领域语言

#### 条件查询 （or / and）
- must查询

        {
          "query": {
            "bool": {
              "must": [
                {
                  "match": {
                    "name": "张三学"
                  }
                },
                {
                  "match": {
                    "score": 70
                  }
                }
              ]
            }
          }
        }
等同于

        GET /_sql?format=txt
        {
          "query": """
          SELECT user_ip,count(*) as count FROM "filebeat-7.5.0-2019.12.21-000001" where name like '%张三学%' and score=70
          """
        }
- should查询

        {
          "query": {
            "bool": {
              "should": [
                {
                  "match": {
                    "name": "张三学"
                  }
                },
                {
                  "match": {
                    "name": "王琨"
                  }
                }
              ]
            }
          }
        }
- must与should组合查询

        {
          "query": {
            "bool": {
              "should": [
                {
                  "bool": {
                    "must": [
                      {}
                    ]
                  }
                },
                {
                  "bool": {
                    "must": [
                      {}
                    ]
                  }
                }
              ]
            }
          }
        }
#### 查询语法
- match查询（模糊查找）

        {
          "query": {
            "match": {
              "title": "北京"
            }
          }
        }
- term查询（精准查找）
    
        select * from test_ik where title="北京奥运"

        {
          "query": {
            "term": {
              "title": "北京奥运"
            }
          }
        }
查询多值使用terms

        select * from test_ik where sku.color in ("red","black")

        {
          "query": {
            "terms": {
              "sku.color": ["red","black"]
            }
          }
        }
- prefix查询（类似于前缀like语句，如 like 'prefix%'）

        select * from test_ik where title like "鸡%"

        {
          "query": {
            "prefix": {
              "title": "鸡"
            }
          }
        }
- regexp查询（正则查询）

        {
          "query": {
            "regexp": {
              "postcode": "W[0-9].+"
            }
          }
        }
prefix、wildcard和regexp查询是基于词操作的，如果用它们来查询analyzed字段，它们会检查字段里面的每个词，而不是将字段作为整体来处理。
所以创建mapping的时候，需要将该字段设置为not_analyzed

        "postcode": {
          "type": "string",
          "index":"not_analyzed" 
        }
- range查询（范围查询）

        select * from tesk_ik where age>=10 and age<20

        {
          "query": {
            "range": {
              "age": {
                "gte": 10,
                "lt": 20
              }
            }
          }
        }