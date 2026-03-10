## JsonResponse
- 设置特殊字符编码处理

		$result = [
            'code' => 1,
            'msg' => 'success',
            'data' => 'app_id=2015052600090779&biz_content={"timeout_express":"30m","seller_id":"","product_code":"QUICK_MSECURITY_PAY","total_amount":"0.01","subject":"1","body":"我是测试数据","out_trade_no":"IQJZSRC1YMQB5HU"}&charset=utf-8&format=json&method=alipay.trade.app.pay&notify_url=http://domain.merchant.com/payment_notify&sign_type=RSA2&timestamp=2016-08-25 20:26:31&version=1.0'
        ];
        $response = new JsonResponse($result);
        $response->setEncodingOptions(JSON_HEX_TAG | JSON_HEX_APOS);
        return $response;

	具体参数见： http://php.net/manual/zh/json.constants.php