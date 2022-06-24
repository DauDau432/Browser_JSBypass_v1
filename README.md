# FlareSolverr

[![Latest release](https://img.shields.io/github/v/release/FlareSolverr/FlareSolverr)](https://github.com/FlareSolverr/FlareSolverr/releases)
[![Docker Pulls](https://img.shields.io/docker/pulls/flaresolverr/flaresolverr)](https://hub.docker.com/r/flaresolverr/flaresolverr/)
[![GitHub issues](https://img.shields.io/github/issues/FlareSolverr/FlareSolverr)](https://github.com/FlareSolverr/FlareSolverr/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr/FlareSolverr/FlareSolverr)](https://github.com/FlareSolverr/FlareSolverr/pulls)
[![Donate PayPal](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=X5NJLLX5GLTV6&source=url)
[![Donate Bitcoin](https://en.cryptobadges.io/badge/micro/13Hcv77AdnFWEUZ9qUpoPBttQsUT7q9TTh)](https://en.cryptobadges.io/donate/13Hcv77AdnFWEUZ9qUpoPBttQsUT7q9TTh)
[![Donate Ethereum](https://en.cryptobadges.io/badge/micro/0x0D1549BbB00926BF3D92c1A8A58695e982f1BE2E)](https://en.cryptobadges.io/donate/0x0D1549BbB00926BF3D92c1A8A58695e982f1BE2E)

FlareSolverr là một máy chủ proxy để vượt qua bảo vệ Cloudflare.

## Làm thế nào nó hoạt động

FlareSolverr khởi động một máy chủ proxy và nó đợi yêu cầu của người dùng ở trạng thái nhàn rỗi sử dụng ít tài nguyên.
Khi một số yêu cầu đến, nó sử dụng [puppeteer](https://github.com/puppeteer/puppeteer) với
[stealth plugin](https://github.com/berstend/puppeteer-extra/tree/master/packages/puppeteer-extra-plugin-stealth)
để tạo một trình duyệt không có đầu (Firefox). Nó mở URL với các thông số người dùng và đợi cho đến khi thử thách Cloudflare
được giải quyết (hoặc hết thời gian chờ). Mã HTML và cookie được gửi lại cho người dùng và những cookie đó có thể được sử dụng để
bỏ qua Cloudflare bằng cách sử dụng các ứng dụng khách HTTP khác.

**Ghi chú**: Trình duyệt web tiêu tốn rất nhiều bộ nhớ. Nếu bạn đang chạy FlareSolverr trên một máy có ít RAM, đừng thực hiện
nhiều yêu cầu cùng một lúc. Với mỗi yêu cầu, một trình duyệt mới được khởi chạy.

Nó cũng có thể sử dụng một phiên cố định. Tuy nhiên, nếu bạn sử dụng các phiên, bạn nên đảm bảo đóng chúng dưới dạng
ngay sau khi bạn hoàn thành việc sử dụng chúng.

## Cài đặt

### Docker

Bạn nên cài đặt bằng cách sử dụng vùng chứa Docker vì dự án phụ thuộc vào trình duyệt bên ngoài
đã được bao gồm trong hình ảnh.

Hình ảnh Docker có sẵn trong:
* GitHub Registry => https://github.com/orgs/FlareSolverr/packages/container/package/flaresolverr
* DockerHub => https://hub.docker.com/r/flaresolverr/flaresolverr

Các phiên bản hệ thống được hỗ trợ là:
| phiên bản | Nhãn |
| :----: | --- |
| x86-64 | linux/amd64 |
| ARM64 | linux/arm64 |
| ARM32 | linux/arm/v7 |

Chúng tôi cung cấp tệp cấu hình `docker-compile.yml`. Sao chép kho lưu trữ này và thực thi `docker-compile up -d` để bắt đầu
thùng chứa.

Nếu bạn thích `docker cli`, hãy thực hiện lệnh sau.
```bash
docker run -d \
  --name=flaresolverr \
  -p 8191:8191 \
  -e LOG_LEVEL=info \
  --restart unless-stopped \
  ghcr.io/flaresolverr/flaresolverr:latest
```

### Các tệp nhị phân được biên dịch trước

Đây là cách được khuyến nghị cho người dùng Windows.
* Tải về [FlareSolverr zip](https://github.com/FlareSolverr/FlareSolverr/releases) từ nội dung của bản phát hành. Nó có sẵn cho Windows và Linux.
* Giải nén tệp zip. Thư mục thực thi FlareSolverr và firefox phải nằm trong cùng một thư mục.
* Thực hiện nhị phân FlareSolverr. Trong phần biến môi trường, bạn có thể tìm thấy cách thay đổi cấu hình.

### Từ mã nguồn

Đây là cách được khuyến nghị cho người dùng macOS và cho các nhà phát triển.
* Cài đặt [NodeJS](https://nodejs.org/) 16.
* Sao chép kho lưu trữ này và mở một trình bao trong đường dẫn đó.
* Chạy `export PUPPETEER_PRODUCT=firefox` (Linux/macOS) hoặc `set PUPPETEER_PRODUCT=firefox` (Windows).
* Chạy `npm install` lệnh để cài đặt các phụ thuộc FlareSolverr.
* Chạy `npm start` lệnh biên dịch mã TypeScript và khởi động FlareSolverr.

Nếu bạn gặp lỗi liên quan đến firefox chưa được cài đặt, hãy thử chạy `node node_modules / puppeteer / install.js` để cài đặt Firefox.

### Dịch vụ Systemd

Chúng tôi cung cấp một tệp đơn vị Systemd mẫu `flaresolverr.service` làm tài liệu tham khảo. Bạn phải sửa đổi tệp cho phù hợp với nhu cầu của mình: đường dẫn, biến người dùng và môi trường.

## Cách sử dụng

Yêu cầu mẫu:
```bash
curl -L -X POST 'http://localhost:8191/v1' \
-H 'Content-Type: application/json' \
--data-raw '{
  "cmd": "request.get",
  "url":"http://www.google.com/",
  "maxTimeout": 60000
}'
```

### Lệnh

#### + `sessions.create`

Thao tác này sẽ khởi chạy một phiên bản trình duyệt mới sẽ giữ lại cookie cho đến khi bạn phá hủy nó bằng `session.destroy`.
Điều này rất hữu ích, vì vậy bạn không phải tiếp tục giải quyết các thử thách lặp đi lặp lại và bạn sẽ không cần tiếp tục gửi
cookie để trình duyệt sử dụng.

Điều này cũng tăng tốc các yêu cầu vì nó sẽ không phải khởi chạy phiên bản trình duyệt mới cho mọi yêu cầu.

Thông số | Ghi chú
|-|-|
phiên họp | Không bắt buộc. ID phiên mà bạn muốn được chỉ định cho phiên bản. Nếu không được đặt, một UUID ngẫu nhiên sẽ được chỉ định.

#### + `sessions.list`

Trả về danh sách tất cả các phiên hoạt động. Nhiều hơn để gỡ lỗi nếu bạn muốn xem có bao nhiêu phiên đang chạy.
Bạn phải luôn đảm bảo đóng đúng cách mỗi phiên khi bạn sử dụng xong chúng vì quá nhiều có thể làm chậm
máy tính bị sập.

Example response:

```json
{
  "sessions": [
    "session_id_1",
    "session_id_2",
    "session_id_3..."
  ]
}
```

#### + `sessions.destroy`

Thao tác này sẽ tắt đúng cách một phiên bản trình duyệt và xóa tất cả các tệp được liên kết với nó để giải phóng tài nguyên cho một phiên bản mới
phiên họp. Khi bạn không cần sử dụng một phiên nữa, bạn nên đảm bảo đóng phiên đó.

Thông số | Ghi chú
|--|--|
session  | ID session mà bạn muốn bị hủy.

#### + `request.get`

Thông số | Ghi chú
|--|--|
url | Bắt buộc
phiên họp | Không bắt buộc. Sẽ gửi yêu cầu từ và phiên bản trình duyệt hiện có. Nếu một trong những không được gửi, nó sẽ tạo ra một phiên bản tạm thời sẽ bị hủy ngay lập tức sau khi yêu cầu được hoàn thành.
maxTimeout | Giá trị mặc định, tùy chọn 60000. Thời gian chờ tối đa để giải quyết thử thách tính bằng mili giây.
bánh quy | Không bắt buộc. Sẽ được sử dụng bởi trình duyệt không đầu. Theo dõi [cái này](https://github.com/puppeteer/puppeteer/blob/v3.3.0/docs/api.md#pagesetcookiecookies) định dạng.
returnOnlyCookies | Tùy chọn, mặc định là false. Chỉ trả lại các cookie. Dữ liệu phản hồi, tiêu đề và các phần khác của phản hồi bị xóa.
proxy | Tùy chọn, mặc định bị vô hiệu hóa. Ví dụ: `"proxy": {"url": "http://127.0.0.1:8888"}`. Bạn phải bao gồm giản đồ proxy trong URL: `http://`, `socks4://` hoặc `socks5://`. Cấp quyền (tên người dùng / mật khẩu) không được hỗ trợ.
:cảnh báo: Nếu bạn muốn sử dụng cookie xóa Cloudflare trong các tập lệnh của mình, hãy đảm bảo rằng bạn cũng sử dụng Tác nhân người dùng FlareSolverr. Nếu chúng không khớp, bạn sẽ thấy thử thách.

Phản hồi ví dụ khi chạy `curl` ở trên:

```json
{
    "solution": {
        "url": "https://www.google.com/?gws_rd=ssl",
        "status": 200,
        "headers": {
            "status": "200",
            "date": "Thu, 16 Jul 2020 04:15:49 GMT",
            "expires": "-1",
            "cache-control": "private, max-age=0",
            "content-type": "text/html; charset=UTF-8",
            "strict-transport-security": "max-age=31536000",
            "p3p": "CP=\"This is not a P3P policy! See g.co/p3phelp for more info.\"",
            "content-encoding": "br",
            "server": "gws",
            "content-length": "61587",
            "x-xss-protection": "0",
            "x-frame-options": "SAMEORIGIN",
            "set-cookie": "1P_JAR=2020-07-16-04; expires=Sat..."
        },
        "response":"<!DOCTYPE html>...",
        "cookies": [
            {
                "name": "NID",
                "value": "204=QE3Ocq15XalczqjuDy52HeseG3zAZuJzID3R57...",
                "domain": ".google.com",
                "path": "/",
                "expires": 1610684149.307722,
                "size": 178,
                "httpOnly": true,
                "secure": true,
                "session": false,
                "sameSite": "None"
            },
            {
                "name": "1P_JAR",
                "value": "2020-07-16-04",
                "domain": ".google.com",
                "path": "/",
                "expires": 1597464949.307626,
                "size": 19,
                "httpOnly": false,
                "secure": true,
                "session": false,
                "sameSite": "None"
            }
        ],
        "userAgent": "Windows NT 10.0; Win64; x64) AppleWebKit/5..."
    },
    "status": "ok",
    "message": "",
    "startTimestamp": 1594872947467,
    "endTimestamp": 1594872949617,
    "version": "1.0.0"
}
```

### + `request.post`

Điều này giống với `request.get` nhưng cần thêm một tham số:

Parameter | Notes
|--|--|
postData | Must be a string with `application/x-www-form-urlencoded`. Eg: `a=b&c=d`

## Các biến môi trường

Name | Default | Notes
|--|--|--|
LOG_LEVEL | info | Verbosity of the logging. Use `LOG_LEVEL=debug` for more information.
LOG_HTML | false | Only for debugging. If `true` all HTML that passes through the proxy will be logged to the console in `debug` level.
CAPTCHA_SOLVER | none | Captcha solving method. It is used when a captcha is encountered. See the Captcha Solvers section.
TZ | UTC | Timezone used in the logs and the web browser. Example: `TZ=Europe/London`.
HEADLESS | true | Only for debugging. To run the web browser in headless mode or visible.
BROWSER_TIMEOUT | 40000 | If you are experiencing errors/timeouts because your system is slow, you can try to increase this value. Remember to increase the `maxTimeout` parameter too.
TEST_URL | https://www.google.com | FlareSolverr makes a request on start to make sure the web browser is working. You can change that URL if it is blocked in your country.
PORT | 8191 | Listening port. You don't need to change this if you are running on Docker.
HOST | 0.0.0.0 | Listening interface. You don't need to change this if you are running on Docker.

Các biến môi trường được thiết lập khác nhau tùy thuộc vào hệ điều hành. Vài ví dụ:
* Docker: Hãy xem phần Docker trong tài liệu này. Các biến môi trường có thể được đặt trong tệp `docker-compos.yml` hoặc trong lệnh Docker CLI.
* Linux: Chạy `export LOG_LEVEL = debug` và sau đó khởi động FlareSolverr trong cùng một trình bao.
* Windows: Mở `cmd.exe`, chạy` set LOG_LEVEL = debug` rồi khởi động FlareSolverr trong cùng một trình bao.

## Trình giải Captcha

:Cảnh báo: Tại thời điểm này, không có trình giải mã hình ảnh xác thực nào hoạt động. Bạn có thể kiểm tra trạng thái trong các vấn đề mở. Mọi sự giúp đỡ đều được hoan nghênh.

Đôi khi CloudFlare không chỉ đưa ra các phép tính toán học và kiểm tra trình duyệt, đôi khi chúng còn yêu cầu người dùng
giải quyết một hình ảnh xác thực.
Nếu đúng như vậy, FlareSolverr sẽ trả về lỗi `Captcha đã được phát hiện nhưng không có bộ giải tự động nào được định cấu hình.'

FlareSolverr có thể được tùy chỉnh để giải mã captcha tự động bằng cách đặt biến môi trường `CAPTCHA_SOLVER`
vào tên tệp của một trong các bộ điều hợp bên trong thư mục [/captcha](src/captcha).

## Các dự án liên quan

* C# thực hiện => https://github.com/FlareSolverr/FlareSolverrSharp
