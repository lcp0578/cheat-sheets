## nsq 初探
- clone代码

		git clone https://github.com/nsqio/nsq
- 使用go mod tidy解决依赖

		$ go mod tidy
        go: downloading github.com/julienschmidt/httprouter v1.3.0
        go: downloading github.com/bmizerany/perks v0.0.0-20141205001514-d9a9656a3a4b
        go: downloading github.com/blang/semver v3.5.1+incompatible
        go: downloading github.com/nsqio/go-nsq v1.0.8
        go: downloading github.com/nsqio/go-diskqueue v1.0.0
        go: downloading github.com/judwhite/go-svc v1.1.2
        go: downloading github.com/mreiferson/go-options v1.0.0
        go: extracting github.com/julienschmidt/httprouter v1.3.0
        go: extracting github.com/bmizerany/perks v0.0.0-20141205001514-d9a9656a3a4b
        go: extracting github.com/blang/semver v3.5.1+incompatible
        go: downloading github.com/bitly/go-hostpool v0.1.0
        go: downloading github.com/bitly/timer_metrics v1.0.0
        go: extracting github.com/nsqio/go-diskqueue v1.0.0
        go: extracting github.com/nsqio/go-nsq v1.0.8
        go: extracting github.com/judwhite/go-svc v1.1.2
        go: extracting github.com/mreiferson/go-options v1.0.0
        go: extracting github.com/bitly/go-hostpool v0.1.0
        go: downloading golang.org/x/sys v0.0.0-20191224085550-c709ea063b76
        go: extracting github.com/bitly/timer_metrics v1.0.0
        go: extracting golang.org/x/sys v0.0.0-20191224085550-c709ea063b76
- make

		$ make
        go build  -o build/nsqd ./apps/nsqd
        go: finding github.com/judwhite/go-svc v1.1.2
        go: finding github.com/mreiferson/go-options v1.0.0
        go: finding github.com/julienschmidt/httprouter v1.3.0
        go: finding github.com/nsqio/go-diskqueue v1.0.0
        go: finding github.com/nsqio/go-nsq v1.0.8
        go: finding github.com/blang/semver v3.5.1+incompatible
        go: finding github.com/bmizerany/perks v0.0.0-20141205001514-d9a9656a3a4b
        go build  -o build/nsqlookupd ./apps/nsqlookupd
        go build  -o build/nsqadmin ./apps/nsqadmin
        go build  -o build/nsq_to_nsq ./apps/nsq_to_nsq
        go: finding github.com/bitly/timer_metrics v1.0.0
        go: finding github.com/bitly/go-hostpool v0.1.0
        go build  -o build/nsq_to_file ./apps/nsq_to_file
        go build  -o build/nsq_to_http ./apps/nsq_to_http
        go build  -o build/nsq_tail ./apps/nsq_tail
        go build  -o build/nsq_stat ./apps/nsq_stat
        go build  -o build/to_nsq ./apps/to_nsq
- 测试

		./test.sh

- nsq组成
	NSQ is composed of 3 daemons:
	- `nsqd` is the daemon that receives, queues, and delivers messages to clients.
	- `nsqlookupd` is the daemon that manages topology information and provides an eventually consistent discovery service.
	- `nsqadmin` is a web UI to introspect the cluster in realtime (and perform various administrative tasks).
- 初步使用
	- start `nsqlookupd`:

			$ ./build/nsqlookupd
            [nsqlookupd] 2020/01/02 10:33:02.250467 INFO: nsqlookupd v1.2.1-alpha (built w/go1.13.5)
            [nsqlookupd] 2020/01/02 10:33:02.251263 INFO: HTTP: listening on [::]:4161
            [nsqlookupd] 2020/01/02 10:33:02.251273 INFO: TCP: listening on [::]:4160
	- in another shell, start `nsqd`:

			$ ./build/nsqd --lookupd-tcp-address=127.0.0.1:4160
            [nsqd] 2020/01/02 10:35:09.397637 INFO: nsqd v1.2.1-alpha (built w/go1.13.5)
            [nsqd] 2020/01/02 10:35:09.397841 INFO: ID: 117
            [nsqd] 2020/01/02 10:35:09.398158 INFO: NSQ: persisting topic/channel metadata to nsqd.dat
            [nsqd] 2020/01/02 10:35:09.403680 INFO: TCP: listening on [::]:4150
            [nsqd] 2020/01/02 10:35:09.403786 INFO: HTTP: listening on [::]:4151
            [nsqd] 2020/01/02 10:35:09.403929 INFO: LOOKUP(127.0.0.1:4160): adding peer
            [nsqd] 2020/01/02 10:35:09.403947 INFO: LOOKUP connecting to 127.0.0.1:4160
            [nsqd] 2020/01/02 10:35:09.405068 INFO: LOOKUPD(127.0.0.1:4160): peer info {TCPPort:4160 HTTPPort:4161 Version:1.2.1-alpha BroadcastAddress:chunpengs-MacBook-Pro-2.local}
	- in another shell, start `nsqadmin`:

			$ ./build/nsqadmin --lookupd-http-address=127.0.0.1:4161
            [nsqadmin] 2020/01/02 10:38:05.879053 INFO: nsqadmin v1.2.1-alpha (built w/go1.13.5)
			[nsqadmin] 2020/01/02 10:38:05.879692 INFO: HTTP: listening on [::]:4171
	- publish an initial message (creates the topic in the cluster, too):

			$ curl -d 'hello world 1' 'http://127.0.0.1:4151/pub?topic=test'
	- finally, in another shell, start `nsq_to_file`:

			$ ./build/nsq_to_file --topic=test --output-dir=/tmp --lookupd-http-address=127.0.0.1:4161
	- publish more messages to `nsqd`:

            $ curl -d 'hello world 2' 'http://127.0.0.1:4151/pub?topic=test'
            $ curl -d 'hello world 3' 'http://127.0.0.1:4151/pub?topic=test'
	- to verify things worked as expected, in a web browser open http://127.0.0.1:4171/ to view the nsqadmin UI and see statistics. Also, check the contents of the log files (test.*.log) written to /tmp.

	- The important lesson here is that `nsq_to_file` (the client) is not explicitly told where the test topic is produced, it retrieves this information from nsqlookupd and, despite the timing of the connection, no messages are lost.
	
    		$ tail -n 10 /tmp/test.chunpengs-MacBook-Pro-2.2020-01-02_10.log
            hello world 1
            hello world 2
            hello world 3