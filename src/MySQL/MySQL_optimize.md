## MySQL Optimize
- count 和 group by优化
	
		SELECT
			count(*) AS num,
			create_type AS type
		FROM
			table_name
		WHERE
			create_at > '2017-06-05'
		AND create_at < '2017-07-05'
		GROUP BY
			create_type;
	建立索引：
		
		CREATE INDEX create_at_type ON table_name (create_type, create_at);
	PS:尽量使varchar字段更小。