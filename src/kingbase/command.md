## 相关命令
- 列出数据库: `\l`
- 列出索引: `\di`
- 列出表： `\dt`
- 列出表结构：`\d {table_name}`
- 查询数据大小写敏感： `show case_sensitive`
- 切换数据库： `\c {dbname}`
- 显示字符集：`\encoding`
- 退出：\q


		test=# \?
		General
		  \copyright             show Kingbase usage and distribution terms
		  \errverbose            show most recent error message at maximum verbosity
		  \g [FILE] or ;         execute query (and send results to file or |pipe)
		  \gexec                 execute query, then execute each value in its result
		  \gset [PREFIX]         execute query and store results in ksql variables
		  \q                     quit ksql
		  \crosstabview [COLUMNS] execute query and display results in crosstab
		  \watch [SEC]           execute query every SEC seconds
		
		Help
		  \? [commands]          show help on backslash commands
		  \? options             show help on ksql command-line options
		  \? variables           show help on special variables
		  \h [NAME]              help on syntax of SQL commands, * for all commands
		
		Query Buffer
		  \e [FILE] [LINE]       edit the query buffer (or file) with external editor
		  \ef [FUNCNAME [LINE]]  edit function definition with external editor
		  \ev [VIEWNAME [LINE]]  edit view definition with external editor
		  \p                     show the contents of the query buffer
		  \r                     reset (clear) the query buffer
		  \s [FILE]              display history or save it to file
		  \w FILE                write query buffer to file
		
		Input/Output
		  \copy ...              perform SQL COPY with data stream to the client host
		  \echo [STRING]         write string to standard output
		  \i FILE                execute commands from file
		  \ir FILE               as \i, but relative to location of current script
		  \o [FILE]              send all query results to file or |pipe
		  \qecho [STRING]        write string to query output stream (see \o)
		
		Informational
		  (options: S = show system objects, + = additional detail)
		  \d[S+]                 list tables, views, and sequences
		  \d[S+]  NAME           describe table, view, sequence, or index
		  \da[S]  [PATTERN]      list aggregates
		  \dA[+]  [PATTERN]      list access methods
		  \db[+]  [PATTERN]      list tablespaces
		  \dc[S+] [PATTERN]      list conversions
		  \dC[+]  [PATTERN]      list casts
		  \dd[S]  [PATTERN]      show object descriptions not displayed elsewhere
		  \ddp    [PATTERN]      list default privileges
		  \dD[S+] [PATTERN]      list domains
		  \det[+] [PATTERN]      list foreign tables
		  \des[+] [PATTERN]      list foreign servers
		  \deu[+] [PATTERN]      list user mappings
		  \dew[+] [PATTERN]      list foreign-data wrappers
		  \df[antw][S+] [PATRN]  list [only agg/normal/trigger/window] functions
		  \dF[+]  [PATTERN]      list text search configurations
		  \dFd[+] [PATTERN]      list text search dictionaries
		  \dFp[+] [PATTERN]      list text search parsers
		  \dFt[+] [PATTERN]      list text search templates
		  \dg[S+] [PATTERN]      list roles
		  \di[S+] [PATTERN]      list indexes
		  \dl                    list large objects, same as \lo_list
		  \dL[S+] [PATTERN]      list procedural languages
		  \dm[S+] [PATTERN]      list materialized views
		  \dn[S+] [PATTERN]      list schemas
		  \do[S]  [PATTERN]      list operators
		  \dO[S+] [PATTERN]      list collations
		  \dp     [PATTERN]      list table, view, and sequence access privileges
		  \dP[+]  [PATTERN] 	 list package
		  \drds [PATRN1 [PATRN2]] list per-database role settings
		  \ds[S+] [PATTERN]      list sequences
		  \dt[S+] [PATTERN]      list tables
		  \dT[S+] [PATTERN]      list data types
		  \du[S+] [PATTERN]      list roles
		  \dv[S+] [PATTERN]      list views
		  \dE[S+] [PATTERN]      list foreign tables
		  \dx[+]  [PATTERN]      list extensions
		  \dy     [PATTERN]      list event triggers
		  \l[+]   [PATTERN]      list databases
		  \sf[+]  FUNCNAME       show a function's definition
		  \sv[+]  VIEWNAME       show a view's definition
		  \z      [PATTERN]      same as \dp
		
		Formatting
		  \a                     toggle between unaligned and aligned output mode
		  \C [STRING]            set table title, or unset if none
		  \f [STRING]            show or set field separator for unaligned query output
		  \H                     toggle HTML output mode (currently off)
		  \pset [NAME [VALUE]]   set table output option
		                         (NAME := {format|border|expanded|fieldsep|fieldsep_zero|footer|null|
		                         numericlocale|recordsep|recordsep_zero|tuples_only|title|tableattr|pager|
		                         unicode_border_linestyle|unicode_column_linestyle|unicode_header_linestyle})
		  \t [on|off]            show only rows (currently off)
		  \T [STRING]            set HTML <table> tag attributes, or unset if none
		  \x [on|off|auto]       toggle expanded output (currently on)
		
		Connection
		  \c[onnect] {[DBNAME|- USER|- HOST|- PORT|-] | conninfo}
		                         connect to new database (currently "wateroa")
		  \encoding [ENCODING]   show or set client encoding
		  \password [USERNAME]   securely change the password for a user
		  \conninfo              display information about current connection
		
		Operating System
		  \cd [DIR]              change the current working directory
		  \setenv NAME [VALUE]   set or unset environment variable
		  \timing [on|off]       toggle timing of commands (currently off)
		  \! [COMMAND]           execute command in shell or start interactive shell
		
		Variables
		  \prompt [TEXT] NAME    prompt user to set internal variable
		  \set [NAME [VALUE]]    set internal variable, or list all if no parameters
		  \unset NAME            unset (delete) internal variable
		
		Large Objects
		  \lo_export LOBOID FILE
		  \lo_import FILE [COMMENT]
		  \lo_list
		  \lo_unlink LOBOID      large object operations
- 格式化输出的结果集

		\x [on|off|auto]       toggle expanded output (currently on)
