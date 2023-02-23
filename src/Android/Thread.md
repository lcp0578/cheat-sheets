## Android主线程、子线程通信（Thread+handler）
- Android是基于Java的，所以也分主线程，子线程！ 
	- 主线程：实现业务逻辑、UI绘制更新、各子线程串连，类似于将军； 
	- 子线程：完成耗时（联网取数据、SD卡数据加载、后台长时间运行）操作，类似于小兵； 

- 一、子线程向主线程发消息（Thread+handler）： 
	- 1、主线程中定义Handler： 

			Handler mHandler = new Handler(){
			
			        @Override
			        public void handleMessage(Message msg) {
			            super.handleMessage(msg);
			            switch (msg.what) {
			            case 0:
			                //do something,refresh UI;
			                break;
			            default:
			                break;
			            }
			        }
			        
			    };
	- 2、子线程处理完耗时操作之后发消息给主线程，更新UI： 

			mHandler.sendEmptyMessage(0);
	这样在子线程与主线程任务分工的条件下完成了消息交互；
- 二、主线程向子线程发送消息（Thread+handler）： 
	- 主线程碰到耗时操作要子线程完成，此时发通知给子线程，操作步骤如下： 
	- 1、子线程中定义Handler，Handler定义在哪个线程中，就跟那个线程绑定，在线程中绑定Handler需要调用Looper.prepare();方法，主线程中不调用是因为主线程默认帮你调用了；

			public class LoopThread implements Runnable {
			
			    public Handler mHandler = null;
			
			    @Override
			    public void run() {
			        Looper.prepare();
			        mHandler = new Handler() {
			            public void handleMessage(Message msg) {
			                String result = NetUtil.getJsonContent("北京");
			                //完成了获取北京天气的操作；
			                Log.i("test", "handler"+result);
			            }
			        };
			        Looper.loop();
			    }
			
			}
	其中Looper.prepare();和Looper.loop();维护了一个消息队列，等待消息注入并在子线程中执行； 
	- 2、主线程中这样调用： 

			lThread.mHandler.sendEmptyMessage(0);
	主线程向子线程发消息，让子线程执行指定的操作，在Android中还有一种方法，即：HandlerThread，看下面的例子： 

			HandlerThread handlerThread = new HandlerThread("jerome");
			        handlerThread.start();
			
			        /**
			         * 这里要将HandlerThread创建的looper传递给threadHandler，即完成绑定；
			         */
			        threadHandler = new Handler(handlerThread.getLooper()) {
			
			            @Override
			            public void handleMessage(Message msg) {
			                super.handleMessage(msg);
			                switch (msg.what) {
			                case 0:
			//这儿可以做耗时的操作；
			                    Log.i("jerome", "hello,I am sub thread");
			                    break;
			                default:
			                    break;
			                }
			            }
			        };