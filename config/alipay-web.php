<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2017/6/26
 * Time: 下午5:21
 */

return [
    //应用ID,您的APPID。
    'app_id' => "2016082100306675",

    //商户私钥 不能用pkcs8.pem中的密钥！！！！！
    'merchant_private_key' => "MIIEpQIBAAKCAQEA5ubgRozW13HumaHM6naAvWILDL2mAYi/kRNc8E4vDvzjqs0ruUXhqutjTm3S0mCO8f6Og08mtd2+RrgIQhrwFHrg279JihH+/oEcKRU9zxGGXYZ7xebezJJ0R6ukcx2e2ClCNchqahF7gjL6E7Hb9/eS6oPCHv+9fgw0MBGlR9/CqwTFnxdwSy1acd52KFKJExxPeDorRUVPPRtMuriEusC0yCl586MJb/UPYLsdOSUXgrd29BHeDKo69KtPobnQNEMH+aY4pGecw/kzoRE2ZAANEtPBQPTjR3OpF1AD67EpB5fDw7wJ7mmsPbpsr6TFTKuTulkCtroXMeFAtBei2wIDAQABAoIBAQDDV4ddqEEJu6Vz6+KEaQS5M3zNppQOsDYA8jSqSDqfn2qsUS8wauJjywgUjezRdkb4i7bdd9Tz/0i+Y2r5IfkCGoKo5ce9O0RS47+DMik8SUM3VFLaNls/Dpe5Gojhqql7jkwpXAhK+8dVevL+PnYt7hEovZc4ynrxbDmqgQMnLZbOaIDDWves9SaJIAZmKge81kxoCrM3unV9uBac9hsqT/CIELiFvFx0eqcgvr+uwePyGxjPgNfN1gT7SUpk/GARKaq0ZIsgxoXbE+vEvltVEmIw9UKVqDnopBu7UIxDw1WDMrRFC0xua/ntzk8id0Y+Rb3NQjse75W07ECuea0hAoGBAPvNlW5YJgbtvQG2LSo+yHvdsq/LGJT951SUry9wKhoiZViJdaTgm9I09PwSMCKkQY4ZdxnQBQDwcL6C6X/M7s1pFIOA4KTd3xmJWP+nP6ao8kXmqc2mw7D2Atrd3WBOAeEz81rJhslME0HIDgpZgkKsOmXEoBPHOsnnorv6Iec9AoGBAOrAG/Tyx9eWvp716ezJTwi505f2wMtBYBjyRd0ITev4GtDzeNuZ3e1eZCSKjwpBQOdrNqwtL0/PMzZK8WrZp/OkVU2b7AN9KpqHlAmH5DcCAQ5kcRQAiO09X7hN5EzBIPOwN69dPcKJqTYN/KDCJjzcogeo2pnJpEFuNoORmBP3AoGBAMiUWj180EXiqRWs9ctaGb+5uTYZlWpR2y1gBzDFq3QIBC0DyofdN6K59pC5OEjQCTxVgq84KlQ2M8k+ZRwdtfhAhUu/pLMP3kDsTM3Rf32VxO/zrz2XYvka7ulDpK2rVgn7pRWjxM+i3xAeeTi7Vm0f3qDkgRNgN69P6izNMqaNAoGAcflh2XSCeHa1CCKnN5Kpr7fhNrfT9RtBl/sQ1nbwti+YfXioZh53dIbOojsvpa/23iTcv42UmfAkkiiiu9j/RTi1PeAFH9CGfc5znoj+0YJElwNHL4nu8RhKQAZ5YJan9AjLkHX5xVjm8dqqnDaHMCeC96sQr3gKKsZi61AmARMCgYEA0x2UihDVpdJorsogXMTeOMyyRx8cHG1g47ZVlqQVP/ftZUQsX7UuEDrHvHCUAk+lZKt4meiej4BgY9TInc8dRbBr6xp/+UiAdsUOhbizlI48hbnr3u0IYC7uRpqacGGvNzoVTx525HGtC0U4SxG5nySZ0SkPU9akXX3dac7poik=",

    //异步通知地址
    'notify_url' => "http://www.edu.cc/home/shop/notify_url",

    //同步跳转
    'return_url' => "http://www.edu.cc/home/shop/return_url",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type' => "RSA2",

    //支付宝网关
    //'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtupSzTt+qFZ95MSYl1PRHwiYzBKggOI6UxaRQ+L4znuulPHcf2TXJf3PNGefUMrVdhUQI+Y4GmHjwc39vzqg5I3Rlip7R0+Zi/YpPlPt1sPt5aRgfX+HUSVvckXV0fFvFVfkv9iF9Cn+yJh88u0BgtNpRKVamtV6UgUVpwRDaF6hEvdXfbiHsj9Q6oTVBs7DAe3mFj4GGjtP2pZLc/Tf91dm95BJLIrSOwJ1qk7nGqxvo4i+EOXS9m9YUHF6pRStsL6Vr7Y6q0NqzevUfcQkhEplgQuQSvfUkK6tQPPAAZh66E+JLlaeufD5yIusHGYLdiTx0Oh9wG5ICUToB05ctwIDAQAB",

    //支付时提交方式 true 为表单提交方式成功后跳转到return_url,
    //false 时为Curl方式 返回支付宝支付页面址址 自己跳转上去 支付成功不会跳转到return_url上， 我也不知道为什么，有人发现可以跳转请告诉 我一下 谢谢
    // email: 40281612@qq.com
    'trade_pay_type' => true,
];