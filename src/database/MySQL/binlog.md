## bin log
- 关键配置`vim /etc/my.cnf`
``` vim
[mysqld]
binlog_format = row    //binlog日志格式，建议使用row
log-bin = mysql-bin    //binlog日志文件
expire_logs_days = 7               //binlog过期清理时间
max_binlog_size = 1G             //binlog每个日志文件大小
binlog_cache_size = 64M            //binlog缓存大小
max_binlog_cache_size = 512M        //最大binlog缓存大小
binlog_row_image = full
```
- [binlog_format](binlog_format.md)  binlog_format模式介绍
- 查看binlog信息
``` SQL
mysql> show variables like'log_bin%';
+---------------------------------+--------------------------------------+
| Variable_name                   | Value                                |
+---------------------------------+--------------------------------------+
| log_bin                         | ON                                   |
| log_bin_basename                | /usr/local/mysql/var/mysql-bin       |
| log_bin_index                   | /usr/local/mysql/var/mysql-bin.index |
| log_bin_trust_function_creators | OFF                                  |
| log_bin_use_v1_row_events       | OFF                                  |
+---------------------------------+--------------------------------------+
5 rows in set (0.01 sec)
```
- [github.com/danfengcao/binlog2sql](https://github.com/danfengcao/binlog2sql) 从MySQL binlog解析出你要的SQL
- mysqlbinlog命令解释
``` bash
    # /usr/local/mysql/bin/mysqlbinlog --help
    /usr/local/mysql/bin/mysqlbinlog Ver 3.4 for Linux at x86_64
    Copyright (c) 2000, 2017, Oracle and/or its affiliates. All rights reserved.

    Oracle is a registered trademark of Oracle Corporation and/or its
    affiliates. Other names may be trademarks of their respective
    owners.

    Dumps a MySQL binary log in a format usable for viewing or for piping to
    the mysql command line client.

    Usage: /usr/local/mysql/bin/mysqlbinlog [options] log-files
      -?, --help          Display this help and exit.
      --base64-output=name
                          Determine when the output statements should be
                          base64-encoded BINLOG statements: 'never' disables it and
                          works only for binlogs without row-based events;
                          'decode-rows' decodes row events into commented
                          pseudo-SQL statements if the --verbose option is also
                          given; 'auto' prints base64 only when necessary (i.e.,
                          for row-based events and format description events).  If
                          no --base64-output[=name] option is given at all, the
                          default is 'auto'.
      --bind-address=name IP address to bind to.
      --character-sets-dir=name
                          Directory for character set files.
      -d, --database=name List entries for just this database (local log only).
      --rewrite-db=name   Rewrite the row event to point so that it can be applied
                          to a new database
      -#, --debug[=#]     This is a non-debug version. Catch this and exit.
      --debug-check       This is a non-debug version. Catch this and exit.
      --debug-info        This is a non-debug version. Catch this and exit.
      --default-auth=name Default authentication client-side plugin to use.
      -D, --disable-log-bin
                          Disable binary log. This is useful, if you enabled
                          --to-last-log and are sending the output to the same
                          MySQL server. This way you could avoid an endless loop.
                          You would also like to use it when restoring after a
                          crash to avoid duplication of the statements you already
                          have. NOTE: you will need a SUPER privilege to use this
                          option.
      -F, --force-if-open Force if binlog was not closed properly.
                          (Defaults to on; use --skip-force-if-open to disable.)
      -f, --force-read    Force reading unknown binlog events.
      -H, --hexdump       Augment output with hexadecimal and ASCII event dump.
      -h, --host=name     Get the binlog from server.
      -i, --idempotent    Notify the server to use idempotent mode before applying
                          Row Events
      -l, --local-load=name
                          Prepare local temporary files for LOAD DATA INFILE in the
                          specified directory.
      -o, --offset=#      Skip the first N entries.
      -p, --password[=name]
                          Password to connect to remote server.
      --plugin-dir=name   Directory for client-side plugins.
      -P, --port=#        Port number to use for connection or 0 for default to, in
                          order of preference, my.cnf, $MYSQL_TCP_PORT,
                          /etc/services, built-in default (3306).
      --protocol=name     The protocol to use for connection (tcp, socket, pipe,
                          memory).
      -R, --read-from-remote-server
                          Read binary logs from a MySQL server. This is an alias
                          for read-from-remote-master=BINLOG-DUMP-NON-GTIDS.
      --read-from-remote-master=name
                          Read binary logs from a MySQL server through the
                          COM_BINLOG_DUMP or COM_BINLOG_DUMP_GTID commands by
                          setting the option to either BINLOG-DUMP-NON-GTIDS or
                          BINLOG-DUMP-GTIDS, respectively. If
                          --read-from-remote-master=BINLOG-DUMP-GTIDS is combined
                          with --exclude-gtids, transactions can be filtered out on
                          the master avoiding unnecessary network traffic.
      --raw               Requires -R. Output raw binlog data instead of SQL
                          statements, output is to log files.
      -r, --result-file=name
                          Direct output to a given file. With --raw this is a
                          prefix for the file names.
      --secure-auth       Refuse client connecting to server if it uses old
                          (pre-4.1.1) protocol. Deprecated. Always TRUE
      --server-id=#       Extract only binlog entries created by the server having
                          the given id.
      --server-id-bits=#  Set number of significant bits in server-id
      --set-charset=name  Add 'SET NAMES character_set' to the output.
      -s, --short-form    Just show regular queries: no extra info and no row-based
                          events. This is for testing only, and should not be used
                          in production systems. If you want to suppress
                          base64-output, consider using --base64-output=never
                          instead.
      -S, --socket=name   The socket file to use for connection.
      --ssl-mode=name     SSL connection mode.
      --ssl               Deprecated. Use --ssl-mode instead.
                          (Defaults to on; use --skip-ssl to disable.)
      --ssl-verify-server-cert
                          Deprecated. Use --ssl-mode=VERIFY_IDENTITY instead.
      --ssl-ca=name       CA file in PEM format.
      --ssl-capath=name   CA directory.
      --ssl-cert=name     X509 cert in PEM format.
      --ssl-cipher=name   SSL cipher to use.
      --ssl-key=name      X509 key in PEM format.
      --ssl-crl=name      Certificate revocation list.
      --ssl-crlpath=name  Certificate revocation list path.
      --tls-version=name  TLS version to use, permitted values are: TLSv1, TLSv1.1
      --start-datetime=name
                          Start reading the binlog at first event having a datetime
                          equal or posterior to the argument; the argument must be
                          a date and time in the local time zone, in any format
                          accepted by the MySQL server for DATETIME and TIMESTAMP
                          types, for example: 2004-12-25 11:25:56 (you should
                          probably use quotes for your shell to set it properly).
      -j, --start-position=#
                          Start reading the binlog at position N. Applies to the
                          first binlog passed on the command line.
      --stop-datetime=name
                          Stop reading the binlog at first event having a datetime
                          equal or posterior to the argument; the argument must be
                          a date and time in the local time zone, in any format
                          accepted by the MySQL server for DATETIME and TIMESTAMP
                          types, for example: 2004-12-25 11:25:56 (you should
                          probably use quotes for your shell to set it properly).
      --stop-never        Wait for more data from the server instead of stopping at
                          the end of the last log. Implicitly sets --to-last-log
                          but instead of stopping at the end of the last log it
                          continues to wait till the server disconnects.
      --stop-never-slave-server-id=#
                          The slave server_id used for --read-from-remote-server
                          --stop-never. This option cannot be used together with
                          connection-server-id.
      --connection-server-id=#
                          The slave server_id used for --read-from-remote-server.
                          This option cannot be used together with
                          stop-never-slave-server-id.
      --stop-position=#   Stop reading the binlog at position N. Applies to the
                          last binlog passed on the command line.
      -t, --to-last-log   Requires -R. Will not stop at the end of the requested
                          binlog but rather continue printing until the end of the
                          last binlog of the MySQL server. If you send the output
                          to the same MySQL server, that may lead to an endless
                          loop.
      -u, --user=name     Connect to the remote server as username.
      -v, --verbose       Reconstruct pseudo-SQL statements out of row events. -v
                          -v adds comments on column data types.
      -V, --version       Print version and exit.
      --open-files-limit=#
                          Used to reserve file descriptors for use by this program.
      -c, --verify-binlog-checksum
                          Verify checksum binlog events.
      --binlog-row-event-max-size=#
                          The maximum size of a row-based binary log event in
                          bytes. Rows will be grouped into events smaller than this
                          size if possible. This value must be a multiple of 256.
      --skip-gtids        Do not preserve Global Transaction Identifiers; instead
                          make the server execute the transactions as if they were
                          new.
      --include-gtids=name
                          Print events whose Global Transaction Identifiers were
                          provided.
      --exclude-gtids=name
                          Print all events but those whose Global Transaction
                          Identifiers were provided.

    Variables (--variable-name=value)
    and boolean options {FALSE|TRUE}  Value (after reading options)
    --------------------------------- ----------------------------------------
    base64-output                     (No default value)
    bind-address                      (No default value)
    character-sets-dir                (No default value)
    database                          (No default value)
    rewrite-db                        (No default value)
    default-auth                      (No default value)
    disable-log-bin                   FALSE
    force-if-open                     TRUE
    force-read                        FALSE
    hexdump                           FALSE
    host                              (No default value)
    idempotent                        FALSE
    local-load                        (No default value)
    offset                            0
    plugin-dir                        (No default value)
    port                              3306
    read-from-remote-server           FALSE
    read-from-remote-master           (No default value)
    raw                               FALSE
    result-file                       (No default value)
    secure-auth                       TRUE
    server-id                         0
    server-id-bits                    32
    set-charset                       (No default value)
    short-form                        FALSE
    socket                            /tmp/mysql.sock
    ssl                               TRUE
    ssl-verify-server-cert            FALSE
    ssl-ca                            (No default value)
    ssl-capath                        (No default value)
    ssl-cert                          (No default value)
    ssl-cipher                        (No default value)
    ssl-key                           (No default value)
    ssl-crl                           (No default value)
    ssl-crlpath                       (No default value)
    tls-version                       (No default value)
    start-datetime                    (No default value)
    start-position                    4
    stop-datetime                     (No default value)
    stop-never                        FALSE
    stop-never-slave-server-id        -1
    connection-server-id              -1
    stop-position                     18446744073709551615
    to-last-log                       FALSE
    user                              (No default value)
    open-files-limit                  64
    verify-binlog-checksum            FALSE
    binlog-row-event-max-size         4294967040
    skip-gtids                        FALSE
    include-gtids                     (No default value)
    exclude-gtids                     (No default value)
```
- 常用选项：
    - --start-position=953                   起始pos点
    - --stop-position=1437                   结束pos点
    - --start-datetime="2019-05-27 13:18:54" 起始时间点
    - --stop-datetime="2019-05-28 13:21:53"  结束时间点
    - --database=zyyshop                     指定只恢复zyyshop数据库(一台主机上往往有多个数据库，只限本地log日志)